<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\AuditoriaController;



Route::resource('citas', CitaMedicaController::class);

Route::get('/agenda/create', [CitaMedicaController::class, 'create'])->name('citas.create');

Route::put('/citas/{id}', [CitaMedicaController::class, 'update'])->name('citas.update');



Route::resource('consultorios', ConsultorioController::class)->names('consultorios');
Route::resource('especialidades', EspecialidadController::class)->names('especialidades');
Route::resource('doctores', DoctorController::class)->names('doctores');
Route::resource('pacientes', PacienteController::class)->names('pacientes');






Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);




Auth::routes();
