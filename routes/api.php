<?php

use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\Paciente\CitaMedicaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/lista-pacientes', [PacienteController::class, 'indexAPI']);


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/perfil', function (Request $request) {
    return response()->json($request->user());
});


    Route::get('/doctores', [CitaMedicaController::class, 'buscarDoctores'])->name('api.doctores');
    Route::get('/tipos_cita', [CitaMedicaController::class, 'buscarTiposCita'])->name('api.tipos_cita');
    Route::get('/consultorios', [CitaMedicaController::class, 'buscarConsultorios'])->name('api.consultorios');