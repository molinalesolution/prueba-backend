<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\PrecioProductoController;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Bienvenido a la API RESTful - Gestión de Productos y Divisas',
        'version' => '1.0 (Por Luis Molina)'
    ]);
});


Route::apiResource('products', ProductoController::class);

Route::get('products/{product}/prices', [PrecioProductoController::class, 'index']);
Route::post('products/{product}/prices', [PrecioProductoController::class, 'store']);
Route::delete('products/{product}/prices/{price}', [PrecioProductoController::class, 'destroy']);
