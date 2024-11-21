<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/empleado/login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
        return $next($request);
    }
}