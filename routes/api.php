<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\ventaController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\proveedorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
   Route::resource('productos', productoController::class);
   Route::resource('ventas', ventaController::class);
   Route::resource('clientes', clienteController::class);
   Route::resource('categorias', categoriaController::class);
   Route::resource('proveedores', proveedorController::class);
   Route::post('/logout', [AuthController::class, 'logout']);

});