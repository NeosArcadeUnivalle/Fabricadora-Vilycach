<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoAuthController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\BIController;
use App\Http\Middleware\CheckAuth;

// Rutas sin autenticación (Login, Logout y Página Principal)
Route::get('empleado/login', [EmpleadoAuthController::class, 'showLoginForm'])->name('empleado.login.form');
Route::post('empleado/login', [EmpleadoAuthController::class, 'login'])->name('empleado.login');
Route::post('empleado/logout', [EmpleadoAuthController::class, 'logout'])->name('empleado.logout');
Route::get('/', function () {
    return view('main.index');
});

// Rutas protegidas con middleware
Route::middleware(CheckAuth::class)->group(function () {
    // BI (Análisis)
    Route::get('/bi', [BIController::class, 'index'])->name('bi.index');

    // Gestión de Empleados
    Route::resource('empleados', EmpleadoController::class);

    // Gestión de Productos
    Route::resource('productos', App\Http\Controllers\ProductoController::class);

    // Gestión de Producción
    Route::resource('produccion', App\Http\Controllers\ProduccionController::class);

    // Gestión de Materia Prima
    Route::resource('materiaprima', App\Http\Controllers\MateriaPrimaController::class);

    // Gestión de Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
    Route::put('/ventas/{id}/updateEstado', [VentaController::class, 'updateEstado'])->name('ventas.updateEstado');
    Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');

    // Notificaciones
    Route::get('/notificaciones', [VentaController::class, 'verNotificaciones'])->name('notificaciones.index');
    Route::post('/notificaciones/marcar-vistas', [VentaController::class, 'marcarNotificacionesVistas'])->name('notificaciones.marcarVistas');
});
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
// Catálogo
Route::get('/catalogo', [CatalogoController::class, 'index']);
// Rutas de autenticación predeterminadas
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta de fallback (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});