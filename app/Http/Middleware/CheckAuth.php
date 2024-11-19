<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario no está autenticado
        if (!Auth::check()) {
            // Redirige al login personalizado
            return redirect('/empleado/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        return $next($request);
    }
}