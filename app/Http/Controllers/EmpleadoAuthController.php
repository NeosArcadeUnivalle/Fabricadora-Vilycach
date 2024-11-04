<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;

class EmpleadoAuthController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.empleado-login');
    }

    // Manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'correoElectronico' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Buscar el empleado por su correo electrónico
        $empleado = Empleado::where('correoElectronico', $request->correoElectronico)->first();

        // Verificar si el empleado existe y la contraseña es correcta
        if ($empleado && Hash::check($request->password, $empleado->password)) {
            // Iniciar sesión
            Auth::login($empleado);

            // Redirigir a la página deseada después del inicio de sesión
            return redirect()->intended('productos');
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'correoElectronico' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}