<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        return response(
            view('usuarios.create', [
                'usuario' => new Usuario(),
                'view' => false
            ])
        );
    }

    public function register(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nom_usuario = $request->nom_usuario;
        $usuario->nick_usuario = $request->nick_usuario;
        $usuario->pass_usuario = Hash::make($request->pass_usuario);
        $usuario->save();

        Auth::login($usuario);
        return redirect(route('login'))->with('success', 'Usuario registrado con éxito');
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('nick_usuario', $request->nick_usuario)->first();

        if ($usuario && Hash::check($request->pass_usuario, $usuario->pass_usuario)) {
            Auth::login($usuario);

            // dd(Auth::login($usuario));

            if (Auth::check()) {
                // Verificar el rol del usuario y redireccionar en consecuencia
                if ($usuario->id_rol == 1) {
                    // Administrador
                    return redirect(route('admin'));
                } elseif ($usuario->id_rol == 2) {
                    // Empleado
                    return redirect(route('index'));
                } else {
                    return back()->with('error', 'Rol no válido');
                }
            }
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    public function logout(Request $request)
    {
        // Lógica de cierre de sesión aquí
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));

    }
}
