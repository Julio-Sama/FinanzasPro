<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Support\Facades\Session;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            view('clientes.index', [
                'clientes' => Cliente::orderBy('nom_cliente', 'asc')->paginate(10)
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
            view('clientes.create', [
                'cliente' => new Cliente(),
                'view' => false
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $cliente = new Cliente();
        $cliente->cod_cliente = $this->generarCodigoCliente();
        $cliente->fill($request->validated());
        $cliente->id_usuario = '1';

        if($cliente->save()){
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente creado exitosamente.');
        }

        return redirect()
            ->route('clientes.index')
            ->with('Error', 'Cliente error.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return response(
            view('clientes.show', [
                'cliente' => $cliente,
                'view' => true
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return response(
            view('clientes.edit', [
                'cliente' => $cliente,
                'view' => false
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->fill($request->validated());

        if($cliente->save()){
            return redirect()
                ->route('clientes.index')
                ->with('success', 'Cliente actualizado exitosamente.');
        }

        return redirect()
            ->route('clientes.index')
            ->with('Error', 'Cliente error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_cliente)
    {
        $cliente = Cliente::findOrFail($id_cliente);

        if($cliente->delete()){
            Session::flash('success', 'Cliente eliminado exitosamente.');
            return response(['success' => true]);
        }

        return response(['success' => false]);
    }

    protected function generarCodigoCliente(){
        // Traer el ultimo registro de la tabla
        $ultimo = Cliente::query()
            ->where('cod_cliente', 'like', 'CL-'.date('Y').'%')
            ->orderBy('id_cliente', 'desc')->first();

        if($ultimo){
            $ultimo = explode('-', $ultimo->cod_cliente);
            $ultimo = $ultimo[2];
        }else{
            $ultimo = 1;
        }

        return 'CL-'.date('Y').'-'.str_pad(
            $ultimo + 1,
            5,
            "0",
            STR_PAD_LEFT
            );
    }
}
