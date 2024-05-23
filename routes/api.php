<?php

use App\Http\Controllers\api\ClienteController;
use App\Http\Controllers\api\PagoController;
use App\Http\Controllers\api\PaqueteController;
use App\Http\Controllers\api\PromocionController;
use App\Http\Controllers\api\ViajeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/clientes', [ClienteController::class, 'store']);  // Esta ruta es crucial para la solicitud POST
Route::get('/clientes/{id}', [ClienteController::class, 'show']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('/pagos', [PagoController::class, 'index'])->name('pagos');
Route::delete('/pagos/{id}', [PagoController::class, 'destroy'])->name('pagos.destroy');
Route::get('/pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
Route::put('/pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');

Route::post('/paquetes', [PaqueteController::class, 'store'])->name('paquetes.store');
Route::get('/paquetes', [PaqueteController::class, 'index'])->name('paquetes');
Route::delete('/paquetes/{paquete}', [PaqueteController::class, 'destroy'])->name('paquetes.destroy');
Route::get('/paquetes/{paquete}', [PaqueteController::class, 'show'])->name('paquetes.show');
Route::put('/paquetes/{paquete}', [PaqueteController::class, 'update'])->name('paquetes.update');

Route::post('/promociones', [PromocionController::class, 'store'])->name('promociones.store');
Route::get('/promociones', [PromocionController::class, 'index'])->name('promociones');
Route::delete('/promociones/{promocion}', [PromocionController::class, 'destroy'])->name('promociones.destroy');
Route::get('/promociones/{promocion}', [PromocionController::class, 'show'])->name('promociones.show');
Route::put('/promociones/{promocion}', [PromocionController::class, 'update'])->name('promociones.update');

Route::post('/viajes', [ViajeController::class, 'store'])->name('viajes.store');
Route::get('/viajes', [ViajeController::class, 'index'])->name('viajes');
Route::delete('/viajes/{viaje}', [ViajeController::class, 'destroy'])->name('viajes.destroy');
Route::get('/viajes/{viaje}', [ViajeController::class, 'show'])->name('viajes.show');
Route::put('/viajes/{viaje}', [ViajeController::class, 'update'])->name('viajes.update');