<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Http\Requests\StoreActivoRequest;
use App\Http\Requests\UpdateActivoRequest;
use App\Models\Tipo;
use Illuminate\Support\Facades\Session;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            view('activos.index', [
                'activos' => Activo::orderBy('descrip_activo', 'asc')->join('tipos', 'activo.id_tipo', '=', 'tipos.id_tipo')->get()
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
        $tipos = Tipo::orderBy('nom_tipo', 'asc')->get();

        return response(
            view('activos.create', [
                'activo' => new Activo(),
                'view' => false,
                'tipos' => $tipos
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivoRequest $request)
    {
        $activo = new Activo();
        $activo->cod_activo = $this->generarCodigoActivo();
        $activo->estado_activo = 'USANDO';
        $activo->fill($request->validated());
        // $activo->id_usuario = '1';

        if ($activo->save()) {
            return redirect()
                ->route('activos.index')
                ->with('success', 'Activo creado correctamente');
        }
        return redirect()
            ->route('activos.index')
            ->with('error', 'No se pudo crear el activo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activo  $activo
     * @return \Illuminate\Http\Response
     */
    public function show(Activo $activo)
    {
        $tipos = Tipo::orderBy('nom_tipo', 'asc')->get();

        return response(
            view('activos.show', [
                'activo' => $activo,
                'tipos' => $tipos,
                'view' => true,
                'show' => true,
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activo  $activo
     * @return \Illuminate\Http\Response
     */
    public function edit(Activo $activo)
    {
        $tipos = Tipo::orderBy('nom_tipo', 'asc')->get();

        return response(
            view('activos.edit', [
                'activo' => $activo,
                'view' => false,
                'tipos' => $tipos
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivoRequest  $request
     * @param  \App\Models\Activo  $activo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivoRequest $request, Activo $activo)
    {
        $activo->fill($request->validated());

        if ($activo->save()) {
            return
                redirect()->route('activos.index')->with('success', 'Activo actualizado correctamente');
        }
        return
            redirect()->route('activos.index')->with('error', 'No se pudo actualizar el activo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activo  $id_activo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activo $id_activo)
    {
        $activo = Activo::findOrfail($id_activo);

        if ($activo->delete()) {
            Session::flash('success', 'Activo eliminado correctamente');
            return response(['success' => true]);
        }
        return response(['success' => false]);
    }

    public function generarCodigoActivo(){
        // Ejemplo de codigo: 2322-5676-8871-0001
        // Codigo de institucion: 2322
        $codigo_institucion = '2322';
        // Codigo de la unidad: 5676
        // Codigo de activo: 8871
        // Codigo de correlativo: 0001

        // Traer el ultimo registro de la tabla
        $ultimo = Activo::query()
        ->where('cod_activo', 'like', 'ACT-'.$codigo_institucion.'%')
        ->orderBy('id_activo', 'desc')
        ->first();

        if($ultimo){
            $ultimo = explode('-', $ultimo->cod_activo);
            $ultimo = $ultimo[2];
        } else {
            $ultimo = 1;
        }

        return 'ACT-'.$codigo_institucion.'-'.str_pad(
            $ultimo + 1, 4, '0', STR_PAD_LEFT);
    }
}
