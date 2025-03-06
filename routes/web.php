<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ventaController;
use App\Http\Controllers\productoController;
Route::get('/', function () {
    return view('welcome');
});


