@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bienvenido Administrador</h1>
        <p>¡Has iniciado sesión!</p>
        <p>Usuario: {{ Auth::user()->name }}</p>
    </div>
@endsection
