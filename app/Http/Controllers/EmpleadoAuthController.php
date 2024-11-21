<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;

class EmpleadoAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.empleado-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correoElectronico' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $credentials = [
            'correoElectronico' => $request->correoElectronico,
            'password' => $request->password,
        ];
    
        if (Auth::guard('web')->attempt($credentials)) {
            return response()->json(['redirect' => url('/productos')]);
        }
    
        return response()->json(['errors' => [
            'correoElectronico' => ['Las credenciales no coinciden con nuestros registros.']
        ]], 422);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return response()->json(['message' => 'Logout successful'], 200);
    }    
}