<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Http\Requests\StoreTipoRequest;
use App\Http\Requests\UpdateTipoRequest;
use Illuminate\Support\Facades\Session;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            view('tipos.index', [
                'tipos' => Tipo::orderBy('nom_tipo', 'asc')->paginate(10)
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
            view('tipos.create', [
                'tipo' => new Tipo(),
                'view' => false
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoRequest $request)
    {
        $tipo = new Tipo();

        $tipo->fill($request->validated());

        if ($tipo->save()) {
            return redirect()->route('tipos.index')->with('success', 'Tipo creado exitosamente.');
        }
        return redirect()->route('tipos.index')->with('Error', 'Error al crear el tipo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo $tipo)
    {
        return response(
            view('tipos.show', [
                'tipo' => $tipo,
                'view' => true
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
    {
        return response(
            view('tipos.edit', [
                'tipo' => $tipo,
                'view' => false
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoRequest  $request
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoRequest $request, Tipo $tipo)
    {
        $tipo->fill($request->validated());

        if ($tipo->save()) {
            return redirect()->route('tipos.index')->with('success', 'Tipo de activo actualizado exitosamente.');
        }

        return redirect()->route('tipos.index')->with('Error', 'Error en actualizar tipo de activo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tipo)
    {
        $tipo = tipo::find($id_tipo);

        if ($tipo->delete()) {
            Session::flash('success', 'Tipo de activo eliminado exitosamente.');
            return response([
                'success' => true
            ]);
        }

        return response([
            'success' => false
        ]);
    }
}
