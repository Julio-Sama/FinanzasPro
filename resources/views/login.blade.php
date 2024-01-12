@extends('layouts.inicio')

@section('content')

<body>
    <h3>Iniciar sesión</h3>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        <form method="POST" action="{{route('iniciar-sesion')}}">
            @csrf
            <label for="nickInput" class="form-label">Nickname:</label>
            <input type="text" class="form-control" id="nickInput" name="nick_usuario" required><br>

            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="pass_usuario" required><br>

            <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
            <label class="form-check-label" for="rememberCheck">Mantener sesión iniciada</label>
            </div>
            <div>
            <p>¿No tienes cuenta? <a href="{{route('registro')}}">Regístrate</a></p>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesion</button>
        </form>
    </body>
@endsection
