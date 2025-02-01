<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\Perfil\PasswordController;

use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AuditoriaController;

// Ruta principal de administración
Route::get('/', [HomeController::class, 'index'])->name('admin.home');

// Ruta de usuarios
Route::resource('users', UserController::class)->middleware('can:admin.users.index') ->names('admin.users');


// Ruta de roles
Route::resource('roles', RolesController::class)->middleware('can:admin.roles.index')->names('admin.roles');



//Ruta de pacientes
Route::resource('pacientes',PacienteController::class)->names('pacientes');

//ACCESO A PERFIL
Route::resource('password', PasswordController::class)->names('cuentas.password');

Route::resource('consultorios', ConsultorioController::class)->middleware('can:admin.consultorios.index')->names('consultorios');
Route::resource('especialidades', EspecialidadController::class)->middleware('can:admin.especialidades.index')->names('especialidades');
Route::resource('doctores', DoctorController::class)->middleware('can:admin.consultorios.index')->names('doctores');
Route::get('auditoria', [AuditoriaController::class, 'index'])->middleware('can:admin.auditoria')->name('auditoria.index');                                                                     


// Rutas para mostrar y editar el perfil

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/perfil/update', [PerfilController::class, 'updateProfile'])->name('perfil.updateProfile');
    Route::post('/perfil/update-password', [PerfilController::class, 'updatePassword'])->name('perfil.updatePassword');
});


