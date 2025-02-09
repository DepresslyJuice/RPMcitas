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

use App\Http\Middleware\CheckAnyPermission;

// ========================
// RUTA PRINCIPAL
// ========================
Route::get('/', [HomeController::class, 'index'])->name('admin.home');

// ========================
// ADMINISTRACIÓN DE USUARIOS Y ROLES
// ========================
Route::resource('users', UserController::class)
    ->middleware('can:admin.admin')
    ->names('admin.users');

// Route::resource('roles', RolesController::class)
//     ->middleware('can:admin.admin')
//     ->names('admin.roles'); // Comenta o descomenta según necesidad

// ========================
// PERFIL Y CONTRASEÑA
// ========================
Route::resource('password', PasswordController::class)
    ->names('cuentas.password');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::post('/perfil/update', [PerfilController::class, 'updateProfile'])->name('perfil.updateProfile');
    Route::post('/perfil/update-password', [PerfilController::class, 'updatePassword'])->name('perfil.updatePassword');
});

// ========================
// GESTIÓN DE CONSULTORIOS, ESPECIALIDADES Y DOCTORES
// ========================
Route::resource('consultorios', ConsultorioController::class)
    ->middleware('can:admin.admin')
    ->names('consultorios');

Route::resource('especialidades', EspecialidadController::class)
    ->middleware('can:admin.admin')
    ->names('especialidades');

Route::resource('doctores', DoctorController::class)
    ->middleware('can:admin.admin')
    ->names('doctores');

Route::get('/reporte-doctores', [DoctorController::class, 'generarReporte'])
    ->middleware('can:admin.admin')
    ->name('reporte-doctores');

// ========================
// AUDITORÍA
// ========================
Route::get('auditoria', [AuditoriaController::class, 'index'])
    ->middleware('can:admin.admin')
    ->name('auditoria.index');
