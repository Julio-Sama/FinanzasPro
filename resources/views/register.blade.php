@extends('layouts.inicio')

@section('styles')
@endsection

@section('content')
    <div class="page-content">
        <div class="container text-center text-dark">
            <div class="row">
                <div class="col-lg-4 d-block mx-auto">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('validar-registro') }}" method="post">
                                        @csrf
                                        <div class="text-center mb-6">
                                            <a class="header-brand1" href="{{ url('index') }}">
                                                <h3>Cañita Store</h3>
                                            </a>
                                        </div>
                                        <h3>Registro</h3>
                                        <p class="text-muted">Crear nueva cuenta</p>
                                        <div class="input-group mb-3">
                                            <span class="input-group-addon bg-white"><i
                                                    class="fa fa-user w-4 text-muted-dark"></i></span>
                                            <input type="text" class="form-control" id="nombreInput" name="nom_usuario"
                                                required placeholder="Ingresu su nombre">
                                        </div>
                                        <div class="input-group mb-4">
                                            <span class="input-group-addon bg-white"><i
                                                    class="fa fa-envelope  text-muted-dark w-4"></i></span>
                                            <input type="text" class="form-control" id="nickInput" name="nick_usuario"
                                                required"
                                                placeholder="Nombre de usuario">
                                        </div>
                                        <div class="input-group mb-4">
                                            <span class="input-group-addon bg-white"><i
                                                    class="fa fa-unlock-alt  text-muted-dark w-4"></i></span>
                                            <input type="password" class="form-control" id="passwordInput"
                                                name="pass_usuario" required
                                                placeholder="Contraseña">
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary btn-block px-4">Registrarse</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <a href="{{ url('login') }}" class="btn btn-link">Volver al inicio de sesión</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
