<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\clienteController;

Route::get('clientes', [clienteController::class, 'index']);
Route::post('clientes', [clienteController::class, 'store']);
Route::get('clientes/{id}', [clienteController::class, 'show']);
Route::put('clientes/{id}', [clienteController::class, 'update']);
Route::delete('clientes/{id}', [clienteController::class, 'destroy']);
Route::patch('clientes/{id}', [clienteController::class, 'updatePartial']);