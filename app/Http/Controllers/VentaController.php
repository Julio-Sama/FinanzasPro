<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleProductoVenta;
use App\Models\Producto;
use App\Models\Venta;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::orderBy('id_venta', 'asc')->paginate(10);
        $ventas->load('cliente', 'usuario');

        return response(
            view('ventas.index', [
                'ventas' => $ventas
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
            view('ventas.create',
                [
                    'venta' => new Venta(),
                    'clientes' => Cliente::orderBy('nom_cliente', 'asc')->get(),
                    'productos' => Producto::orderBy('descrip_producto', 'asc')->get()
                ]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVentaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVentaRequest $request)
    {
        $venta = new Venta();
        $venta->fech_venta = date('Y-m-d');
        $venta->estado_venta = 'Finalizada';
        $venta->id_usuario = 1; // TODO: Cambiar por el usuario logueado

        $venta->fill($request->validated());

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

        if($venta->save()){
            foreach($detalles as $detalle){
                $detalleProductoVenta = new DetalleProductoVenta();
                $detalleProductoVenta->id_venta = $venta->id_venta;
                $detalleProductoVenta->id_producto = $detalle['id_producto'];
                $detalleProductoVenta->cant_detalle_venta = $detalle['cant_detalle_venta'];
                $detalleProductoVenta->precio_detalle_venta = $detalle['precio_detalle_venta'];
                $detalleProductoVenta->save();

                $producto = Producto::find($detalle['id_producto']);
                $producto->stock_producto = $producto->stock_producto - $detalle['cant_detalle_venta'];
                $producto->save();
            }
        }

        return response(
            [
                'success' => true,
                'redirect' => route('ventas.index')
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVentaRequest  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
