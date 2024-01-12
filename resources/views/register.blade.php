@extends('layouts.inicio')

@section('content')
    <body>
            <form method="POST" action="{{route('validar-registro')}}">
                @csrf
                    <label for="nombreInput" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreInput"
                    name="nom_usuario" required autocomplete="disable">

                    <label for="nickInput" class="form-label">Nickname</label>
                    <input type="text" class="form-control" id="nickInput"
                    name="nick_usuario" required autocomplete="disable">
                
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="passwordInput"
                    name="pass_usuario" required autocomplete="disable">
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
    </body>
@endsection