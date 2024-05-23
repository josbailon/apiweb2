<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\clienteController;
use App\Http\Controllers\Api\vehiculoController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Facedes\Hash;
use App\Http\Controllers\Api\PagosController;

/*

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

//rutas de cliente 
Route::get('clientes', [clienteController::class, 'index']);
Route::post('clientes', [clienteController::class, 'store']);
Route::get('clientes/{id}', [clienteController::class, 'show']);
Route::put('clientes/{id}', [clienteController::class, 'update']);
Route::delete('clientes/{id}', [clienteController::class, 'destroy']);
Route::patch('clientes/{id}', [clienteController::class, 'updatePartial']);
// rutas de vehiculo
Route::get('vehiculos', [vehiculoController::class, 'index']);
Route::get('vehiculos/{id}', [vehiculoController::class, 'show']);
Route::post('vehiculos', [vehiculoController::class, 'store']);
Route::put('vehiculos/{id}', [vehiculoController::class, 'update']);
Route::delete('vehiculos/{id}', [vehiculoController::class, 'destroy']);
Route::patch('vehiculos/{id}', [vehiculoController::class, 'updatePartial']);
// rutas de pago

Route::get('/pagos', [PagosController::class, 'index']);
Route::post('/pagos', [PagosController::class, 'store']);
Route::get('/pagos/{id}', [PagosController::class, 'show']);
Route::put('/pagos/{id}', [PagosController::class, 'update']);
Route::delete('/pagos/{id}', [PagosController::class, 'destroy']);


/*
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('clientes', [ClienteController::class, 'index']);
    Route::post('clientes', [ClienteController::class, 'store']);
    Route::get('clientes/{id}', [ClienteController::class, 'show']);
    Route::put('clientes/{id}', [ClienteController::class, 'update']);
    Route::patch('clientes/{id}', [ClienteController::class, 'updatePartial']);
    Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);
});
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
