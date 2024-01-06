<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Http\Requests\StoreActivoRequest;
use App\Http\Requests\UpdateActivoRequest;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activo  $activo
     * @return \Illuminate\Http\Response
     */
    public function show(Activo $activo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activo  $activo
     * @return \Illuminate\Http\Response
     */
    public function edit(Activo $activo)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activo  $activo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activo $activo)
    {
        //
    }
}