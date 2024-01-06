<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            view('categorias.index', [
                'categorias' => Categoria::orderBy('nom_categoria', 'asc')->paginate(10)
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
            view('categorias.create', [
                'categoria' => new Categoria(),
                'view' => false
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = new Categoria();

        $categoria->fill($request->validated());

        if($categoria->save()){
            return redirect()->route('categorias.index')->with('success', 'Categoria creada exitosamente.');
        }

        return redirect()->route('categorias.index')->with('Error', 'Categoria error.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return response(
            view('categorias.show', [
                'categoria' => $categoria,
                'view' => true
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return response(
            view('categorias.edit', [
                'categoria' => $categoria,
                'view' => false
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriaRequest  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->fill($request->validated());

        if($categoria->save()){
            return redirect()->route('categorias.index')->with('success', 'Categoria actualizada exitosamente.');
        }

        return redirect()->route('categorias.index')->with('Error', 'Categoria error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_categoria)
    {
        $categoria = Categoria::find($id_categoria);

        if($categoria->delete()){
            Session::flash('success', 'Categoria eliminada exitosamente.');
            return response([
                'success' => true
            ]);
        }

        return response([
            'success' => false
        ]);
    }
}
