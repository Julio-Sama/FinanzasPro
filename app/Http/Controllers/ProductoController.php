<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\DetalleProductoCompra;
use App\Models\DetalleProductoVenta;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Venta;
use Illuminate\Support\Facades\Session;
use SplQueue;
use SplStack;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            view('productos.index', [
                'productos' => Producto::orderBy('descrip_producto', 'asc')->join('categoria', 'producto.id_categoria', '=', 'categoria.id_categoria')->get()
            ])
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nom_categoria', 'asc')->get();

        return response(
            view('productos.create', [
                'producto' => new Producto(),
                'view' => false,
                'categorias' => $categorias
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {
        $producto = new Producto();
        $producto->stock_producto = 0;
        $producto->precio_compra_producto = 0;

        $producto->fill($request->validated());

        if ($producto->save()) {
            return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
        }

        return redirect()->route('productos.index')->with('Error', 'Producto error.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $categorias = Categoria::orderBy('nom_categoria', 'asc')->get();

        return response(
            view('productos.show', [
                'producto' => $producto,
                'view' => true,
                'categorias' => $categorias
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('nom_categoria', 'asc')->get();

        return response(
            view('productos.edit', [
                'producto' => $producto,
                'view' => false,
                'categorias' => $categorias
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductoRequest $request
     * @param \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $producto->fill($request->validated());

        if ($producto->save()) {
            return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
        }

        return redirect()->route('productos.index')->with('Error', 'Producto error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);

        if ($producto->delete()) {
            Session::flash('success', 'Producto eliminado exitosamente.');
            return response(['success' => true]);
        }

        return response(['success' => false]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kardex()
    {
        // Años de las ventas y compras registradas
        $aniosVentas = Venta::selectRaw('YEAR(fech_venta) as anio')->groupBy('anio')->orderBy('anio', 'desc')->get();
        $aniosCompras = Compra::selectRaw('YEAR(fech_compra) as anio')->groupBy('anio')->orderBy('anio', 'desc')->get();

        $anios = [];

        foreach ($aniosVentas as $venta) {
            array_push($anios, $venta->anio);
        }

        foreach ($aniosCompras as $compra) {
            array_push($anios, $compra->anio);
        }

        $anios = array_unique($anios);

        // Unir las ventas y compras en un solo array
        $kardex = [];

        // Obtener el id del producto y el año
        $id_producto = request()->get('id_producto');
        $anio = request()->get('anio');

        $ventas = DetalleProductoVenta::all()
            ->where('id_producto', $id_producto);
        $compras = DetalleProductoCompra::all()
            ->where('id_producto', $id_producto);

        $ventas->load('producto', 'venta');
        $compras->load('producto', 'compra');

        $kardex = array_merge($kardex, $ventas->toArray());
        $kardex = array_merge($kardex, $compras->toArray());

        // Ordenar el array por fecha
        usort($kardex, function ($a, $b) {
            return $a['created_at'] <=> $b['created_at'];
        });

        $array = [];

        $cola = new SplQueue();

        // Cambiar atributos de las ventas y compras para que sean iguales
        foreach ($kardex as $key => $value) {
            if (array_key_exists('id_compra', $value)){ // Compra

                // Push en el array
                $array[] = $this->getRow(
                    $value['id_compra'],
                    'Compra',
                    $value['created_at'],
                    $value['cant_detalle_compra'],
                    $value['precio_detalle_compra'],
                    $value['precio_detalle_compra'] * $value['cant_detalle_compra'],
                    $value['cant_detalle_compra'],
                    $value['precio_detalle_compra'] * $value['cant_detalle_compra']
                );

                $cola->enqueue($value);
            } else { // Venta
                do {
                    $compra = $cola->bottom();

                    $cantCompra = $compra['cant_detalle_compra'];
                    $cantVenta = $value['cant_detalle_venta'];

                    if ($cantCompra >= $cantVenta) {
                        $array[] = $this->getRow(
                            $value['id_venta'],
                            'Venta',
                            $compra['created_at'],
                            $value['cant_detalle_venta'],
                            $compra['precio_detalle_compra'],
                            $compra['precio_detalle_compra'] * $value['cant_detalle_venta'],
                            $cantCompra - $cantVenta,
                            $compra['precio_detalle_compra'] * ($cantCompra - $cantVenta)
                        );

                        // Actualizar la cantidad de la compra en la cola
                        $compra['cant_detalle_compra'] = $cantCompra - $cantVenta;


                        // Cola Actualizada
                        $cola->offsetSet(0, $compra);

                    } else {
                        $array[] = $this->getRow(
                            $value['id_venta'],
                            'Venta',
                            $compra['created_at'],
                            $cantCompra,
                            $compra['precio_detalle_compra'],
                            $compra['precio_detalle_compra'] * $cantCompra,
                            0,
                            0
                        );

                        $value['cant_detalle_venta'] -= $cantCompra;
                        $cola->dequeue();

                    }
                }while($cantCompra < $cantVenta);

                // Imprimir resto de compras en cola sin eliminarlas omitiendo la primera
                for ($i = 1; $i < $cola->count(); $i++) {
                    $compra = $cola->offsetGet($i);

                    $array[] = $this->getRow(
                        $compra['id_compra'],
                        'Saldo',
                        $compra['created_at'],
                        $compra['cant_detalle_compra'],
                        $compra['precio_detalle_compra'],
                        $compra['precio_detalle_compra'] * $compra['cant_detalle_compra'],
                        $compra['cant_detalle_compra'],
                        $compra['precio_detalle_compra'] * $compra['cant_detalle_compra']
                    );
                }
            }
        }

        return response(
            view('kardex.index', [
                'productos' => Producto::orderBy('descrip_producto', 'asc')->get(),
                'anios' => $anios,
                'kardex' => $array,
                'id_producto' => $id_producto,
                'anio' => $anio
            ])
        );
    }


    public function getRow($descripcion, $tipo, $fecha, $cant, $costo_unit, $costo_total, $cant_saldo, $costo_saldo): array
    {
        $array = [];
        $array['descripcion'] = $descripcion;
        $array['tipo'] = $tipo;
        $array['fecha'] = date('d/m/Y H:i', strtotime($fecha));
        $array['cant'] = $cant;
        $array['costo_unit'] = number_format($costo_unit, 2, '.', ',');
        $array['costo_total'] = number_format($costo_total, 2, '.', ',');
        $array['cant_saldo'] = $cant_saldo;
        $array['costo_saldo'] = number_format($costo_saldo, 2, '.', ',');
        return $array;
    }


}
