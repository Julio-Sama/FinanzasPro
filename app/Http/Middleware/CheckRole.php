<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if (!in_array($request->user()->id_rol, $roles)) {
            return redirect(route('login'))->with('error', 'No tienes permisos para acceder a esta página');
        }

        return $next($request);
    }
}
