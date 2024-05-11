<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\clienteController;
use App\Http\Controllers\Api\vehiculoController;

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
