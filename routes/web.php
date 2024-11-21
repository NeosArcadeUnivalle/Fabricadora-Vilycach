<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoAuthController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\BIController;
use App\Http\Middleware\CheckAuth;

Route::get('empleado/login', [EmpleadoAuthController::class, 'showLoginForm'])->name('empleado.login.form');
Route::post('empleado/login', [EmpleadoAuthController::class, 'login'])->name('empleado.login');
Route::post('empleado/logout', [EmpleadoAuthController::class, 'logout'])->name('empleado.logout');
Route::get('/', function () {
    return view('main.index');
});

Route::middleware(CheckAuth::class)->group(function () {

    Route::get('/bi', [BIController::class, 'index'])->name('bi.index');
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('productos', App\Http\Controllers\ProductoController::class);
    Route::resource('produccion', App\Http\Controllers\ProduccionController::class);
    Route::resource('materiaprima', App\Http\Controllers\MateriaPrimaController::class);

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
    Route::put('/ventas/{id}/updateEstado', [VentaController::class, 'updateEstado'])->name('ventas.updateEstado');
    Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');

    Route::get('/notificaciones', [VentaController::class, 'verNotificaciones'])->name('notificaciones.index');
    Route::post('/notificaciones/marcar-vistas', [VentaController::class, 'marcarNotificacionesVistas'])->name('notificaciones.marcarVistas');
});

Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');

Route::get('/catalogo', [CatalogoController::class, 'index']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});