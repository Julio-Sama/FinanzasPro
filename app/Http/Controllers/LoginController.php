<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Import the Usuario class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        // Lógica de registro aquí
        $usuario = new Usuario();
        $usuario->nom_usuario = $request->nom_usuario;
        $usuario->nick_usuario = $request->nick_usuario;
        $usuario->pass_usuario = Hash::make($request->pass_usuario);

        $usuario->save();

        Auth::login($usuario);
        // Redireccionar al usuario después del registro
        return redirect(route('login'));
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('nick_usuario', $request->nick_usuario)->first();
        // Lógica de autenticación aquí
        
        $hashedPassword = $usuario->pass_usuario; // La contraseña encriptada almacenada en la base de datos
        $plainPassword = $request->pass_usuario; // La contraseña en texto plano que el usuario ha enviado
     
        $credentials = $request->only('nick_usuario', 'pass_usuario');

       // $credentials = [ 
       //     "nick_usuario" => $request->nick_usuario, 
       //     "pass_usuario" => $request->pass_usuario, 
        //"active" => true 
       // ];
        $remember = ($request->has('remember') ? true : false);

        if (Auth::validate($credentials)) {
            // Authentication was successful...

            error_log(print_r($plainPassword, true));

            $request->session()->regenerate();
            return redirect()->intended(route('index'))->with('success', 'Inicio de sesión exitoso!');
       
        } else {
            // Authentication was unsuccessful...

            error_log(print_r($hashedPassword, true));

            return redirect(route('login'))->with('error', 'Error en el inicio de sesión.');
        }

        // Redireccionar al usuario después del inicio de sesión
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
