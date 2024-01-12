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
                                <form action="{{ route('iniciar-sesion') }}" method="post">
                                    @csrf
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <div class="text-center mb-2">
                                            <a class="header-brand1" href="{{ url('index') }}">
                                                <h3>Cañita Store</h3>
                                            </a>
                                        </div>

                                        <h3>Inicio de Sesión</h3>
                                        <p class="text-muted">Ingresa a tu cuenta</p>
                                        <div class="input-group mb-3">
                                            <span class="input-group-addon bg-white"><i
                                                    class="fa fa-user text-dark"></i></span>
                                            <input type="text" class="form-control" id="nickInput" name="nick_usuario"
                                                required placeholder="Nombre de usuario">
                                        </div>
                                        <div class="input-group mb-4">
                                            <span class="input-group-addon bg-white"><i
                                                    class="fa fa-unlock-alt text-dark"></i></span>
                                            <input type="password" class="form-control" id="passwordInput"
                                                name="pass_usuario" required placeholder="Contraseña">
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 form-check">
                                                <label class="custom-control custom-checkbox mb-0">
                                                    <input type="checkbox" class="custom-control-input" id="rememberCheck"
                                                        name="remember">
                                                    <span class="custom-control-label fw-semibold">Mantener sesión
                                                        iniciada.</span>
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <p>¿No tienes cuenta? <a href="{{ route('registro') }}"> Registrate </a>
                                                </p>
                                                <br>
                                                <button type="submit" class="btn btn-square btn-primary">Iniciar
                                                    sesión</button>
                                            </div>
                                            {{-- boton de iniciar sesion --}}


                                        </div>
                                </form>
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
