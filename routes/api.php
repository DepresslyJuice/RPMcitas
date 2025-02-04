<?php

use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/lista-pacientes', [PacienteController::class, 'indexAPI']);


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/perfil', function (Request $request) {
    return response()->json($request->user());
});
