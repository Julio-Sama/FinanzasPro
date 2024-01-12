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
        return redirect(route('clientes'));
    }

    public function login(Request $request)
    {
        // Verificar si el usuario existe
        $usuario = Usuario::where('nick_usuario', $request->nick_usuario )->first();

        if (!$usuario) {
            return redirect(route('login'))->with('error', 'No existe el usuario.');
        }

        // Comparar contraseñas usando el método de hashing de Laravel
        $plainPassword = $request->pass_usuario;
        $hashedPassword = $usuario->pass_usuario;



        if (Hash::check($plainPassword, $hashedPassword)) {
            // Autenticación exitosa

            $credentials = $request->only('nick_usuario', 'pass_usuario');
            $remember = $request->has('remember');

            if (Auth::attempt($credentials, $remember)) {
                return redirect()->intended(route('index'))
                    ->with('success', 'Inicio de sesión exitoso!');
            } else {
                // dd(Auth::getLastAttempted());
                return redirect(route('login'))
                    ->with('error', 'Error en el inicio de sesión. [Aqui fallo]');
            }
        } else {
            // Contraseña incorrecta
            return redirect(route('login'))
                ->with('error', 'Error en el inicio de sesión!.');
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
}
