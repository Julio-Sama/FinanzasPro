<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Import the Usuario class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create()
    {
        //
        return response(
            view('usuarios.create', [
                'usuario' => new Usuario(),
                'view' => false
            ])
        );
    }

    public function register(Request $request)
    {

        // Lógica de registro aquí
        $usuario = new Usuario();
        $usuario->nom_usuario = $request->nom_usuario;
        $usuario->nick_usuario = $request->nick_usuario;
        $usuario->pass_usuario = Hash::make($request->pass_usuario);

        // Quiero guardar por defecto el rol de usuario "Empleado" que es el id_rol = 2
        $usuario->id_rol = 2;

        $usuario->save();

        Auth::login($usuario);
        // Redireccionar al usuario después del registro
        return redirect(route('login')) . with('success', 'Usuario registrado con éxito');
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('nick_usuario', $request->nick_usuario)->first();
        if ($usuario && Hash::check($request->pass_usuario, $usuario->pass_usuario)) {
            Auth::login($usuario);
            if (Auth::check()) {
                // return 'Autenticado';
                return redirect(route('index'));
            } else {
                return back()->with('error', '');
            }
        } else {
            return back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function logout(Request $request)
    {
        // Lógica de cierre de sesión aquí
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
        // Redireccionar al usuario después del cierre de sesión
    }

    protected $redirectTo = "/index";
}
