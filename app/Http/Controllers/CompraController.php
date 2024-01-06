<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\DetalleProductoCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Session;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::orderBy('id_compra', 'asc')->paginate(10);
        $compras->load('proveedor', 'usuario');

        return response(
            view('compras.index', [
                'compras' => $compras
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
        return response(
            view('compras.create',
                [
                    'compra' => new Compra(),
                    'proveedores' => Proveedor::orderBy('nom_proveedor', 'asc')->get(),
                    'productos' => Producto::orderBy('descrip_producto', 'asc')->get()
                ]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompraRequest $request)
    {
        $compra = new Compra();
        $compra->fech_compra = date('Y-m-d');
        $compra->estado_compra = 'Pendiente';
        $compra->id_usuario = 1; // TODO: Cambiar por el usuario logueado

        $compra->fill($request->validated());

        $detalles = json_decode($request->productos, true);

        if($detalles == null){
            return response(
                [
                    "message" => "Debe agregar al menos un producto al detalle.",
                    "errors" => [
                        "productos" => [
                            "Debe agregar al menos un producto al detalle."
                        ]
                    ]
                ]
            );
        }

        if($compra->save()){
            foreach ($detalles as $detalle) {
                $detalleProductoCompra = new DetalleProductoCompra();
                $detalleProductoCompra->id_compra = $compra->id_compra;
                $detalleProductoCompra->id_producto = $detalle['id_producto'];
                $detalleProductoCompra->cant_detalle_compra = $detalle['cant_detalle_compra'];
                $detalleProductoCompra->precio_detalle_compra = $detalle['precio_detalle_compra'];
                $detalleProductoCompra->save();
            }
        }

        $request->session()->flash('success', 'Compra creada exitosamente.');
        return response(
            [
                'success' => true,
                'redirect' => route('compras.index')
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        $compra->load('proveedor', 'usuario', 'detalleProductoCompra.producto');

        return response(
            view('compras.show', [
                'compra' => $compra,
                'productos' => null,
                'proveedores' => Proveedor::orderBy('nom_proveedor', 'asc')->get()
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id_compra
     * @return \Illuminate\Http\Response
     */
    public function update($id_compra)
    {
        $compra = Compra::find($id_compra);

        if($compra->estado_compra == 'Pendiente'){
            $compra->estado_compra = 'Finalizada';
            $compra->save();

            // Actualizar stock de productos
            $detalles = DetalleProductoCompra::where('id_compra', $id_compra)->get();

            foreach ($detalles as $detalle) {
                $producto = Producto::find($detalle->id_producto);
                $producto->stock_producto += $detalle->cant_detalle_compra;
                $producto->precio_compra_producto = $detalle->precio_detalle_compra;
                $producto->save();
            }

            Session::flash('success', 'Compra recibida exitosamente.');
            return response(['success' => true]);
        }

        return response(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_compra
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_compra)
    {
        $compra = Compra::find($id_compra);

        if($compra->delete()){
            Session::flash('success', 'Compra anulada exitosamente.');
            return response(['success' => true]);
        }

        return response(['success' => false]);
    }
}
