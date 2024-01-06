<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use Illuminate\Support\Facades\Session;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            view('proveedores.index', [
                'proveedores' => Proveedor::orderBy('nom_proveedor', 'asc')->paginate(10)
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
            view('proveedores.create', [
                'proveedor' => new Proveedor(),
                'view' => false
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProveedorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProveedorRequest $request)
    {
        $proveedor = new Proveedor();

        $proveedor->fill($request->validated());

        if($proveedor->save()){
            return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
        }

        return redirect()->route('proveedores.index')->with('Error', 'Proveedor error.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        return response(
            view('proveedores.show', [
                'proveedor' => $proveedor,
                'view' => true
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        return response(
            view('proveedores.edit', [
                'proveedor' => $proveedor,
                'view' => false
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProveedorRequest  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor->fill($request->validated());

        if($proveedor->save()){
            return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
        }

        return redirect()->route('proveedores.index')->with('Error', 'Proveedor error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_proveedor)
    {
        $proveedor = Proveedor::find($id_proveedor)->first();

        if($proveedor->delete()){
            Session::flash('success', 'Proveedor eliminado exitosamente.');
            return response(['status' => true]);
        }

        return response(['status' => false]);
    }
}
