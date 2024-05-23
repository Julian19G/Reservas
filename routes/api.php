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

Route::get('/pagos', [PagoController::class, 'index'])->name('pagos.index');
Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('/pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
Route::put('/pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('/pagos/{id}', [PagoController::class, 'destroy'])->name('pagos.destroy');

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

Route::get('/viajes', [ViajeController::class, 'index'])->name('viajes');
Route::post('/viajes', [ViajeController::class, 'store'])->name('viajes.store');
Route::get('/viajes/{id}', [ViajeController::class, 'show'])->name('viajes.show');
Route::put('/viajes/{id}', [ViajeController::class, 'update'])->name('viajes.update');
Route::delete('/viajes/{id}', [ViajeController::class, 'destroy'])->name('viajes.destroy');