<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoAuthController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CatalogoController;

// Rutas para las vistas
Route::resource('empleados', EmpleadoController::class);
Route::resource('productos', App\Http\Controllers\ProductoController::class);
Route::resource('produccion', App\Http\Controllers\ProduccionController::class);
Route::resource('materiaprima', App\Http\Controllers\MateriaPrimaController::class);

// Ruta para la vista principal
Route::get('/', function () {
    return view('main.index');  // Apunta a la vista 'resources/views/main/index.blade.php'
});

// Rutas de autenticación para empleados
Route::get('empleado/login', [EmpleadoAuthController::class, 'showLoginForm'])->name('empleado.login.form');
Route::post('empleado/login', [EmpleadoAuthController::class, 'login'])->name('empleado.login');
Route::post('empleado/logout', [EmpleadoAuthController::class, 'logout'])->name('empleado.logout');

// Rutas para las ventas
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
Route::put('/ventas/{id}/updateEstado', [VentaController::class, 'updateEstado'])->name('ventas.updateEstado');
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');

// Ruta para obtener las ventas en JSON, usada en el componente Vue
Route::get('/api/ventas', [VentaController::class, 'getVentas'])->name('api.ventas.index');

// Rutas de autenticación predeterminadas de Laravel
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta de API para obtener empleados en JSON (solo para referencia)
Route::get('/api/empleados', [EmpleadoController::class, 'getEmpleados']);
Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');

Route::get('/catalogo', [CatalogoController::class, 'index']);

Route::get('/notificaciones', [VentaController::class, 'verNotificaciones'])->name('notificaciones.index');
Route::post('/notificaciones/marcar-vistas', [VentaController::class, 'marcarNotificacionesVistas'])->name('notificaciones.marcarVistas');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});