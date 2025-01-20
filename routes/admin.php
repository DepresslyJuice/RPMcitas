<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\Perfil\PasswordController;
// Ruta principal de administración
Route::get('/', [HomeController::class, 'index'])->name('admin.home');

// Ruta de usuarios
Route::resource('users', UserController::class)->names('admin.users');


// Ruta de roles
Route::resource('roles', RolesController::class)->names('admin.roles');



//Ruta de pacientes
Route::resource('pacientes',PacienteController::class)->names('pacientes');

//ACCESO A PERFIL
Route::resource('perfiles', PerfilController::class)->names('cuentas.perfil');
Route::resource('password', PasswordController::class)->names('cuentas.password');

