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

use App\Http\Middleware\CheckAnyPermission;

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Rutas de citas médicas
    //solo dentista
    // Rutas comunes para ambos permisos (dentista.citas y citas)
    Route::middleware(['auth', CheckAnyPermission::class . ':dentista.citas,citas'])
        ->group(function () {
            Route::get('/citas', [CitaMedicaController::class, 'index'])->name('citas.index');
            Route::get('/citas/{cita}', [CitaMedicaController::class, 'show'])->name('citas.show');
            Route::patch('/citas/{cita}/finalizar', [CitaMedicaController::class, 'actualizarEstado'])->name('citas.finalizar');
        });

    // Rutas solo para el permiso 'citas' (admin y secretaria)
    Route::middleware(['auth', CheckAnyPermission::class . ':citas'])
        ->group(function () {
            Route::get('/citas/create', [CitaMedicaController::class, 'create'])->name('citas.create');
            Route::post('/citas', [CitaMedicaController::class, 'store'])->name('citas.store');
            Route::get('/citas/{cita}/edit', [CitaMedicaController::class, 'edit'])->name('citas.edit');
            Route::put('/citas/{cita}', [CitaMedicaController::class, 'update'])->name('citas.update');
            Route::delete('/citas/{cita}', [CitaMedicaController::class, 'destroy'])->name('citas.destroy');
        });


    Route::get('/agenda/create', [CitaMedicaController::class, 'create'])->name('citas.create');
    Route::put('/citas/{id}', [CitaMedicaController::class, 'update'])->name('citas.update');
    Route::patch('/citas/{cita}/finalizar', [CitaMedicaController::class, 'actualizarEstado'])->name('citas.finalizar');

    // Rutas de pacientes
    Route::get('/pacientes/{id}/historial', [PacienteController::class, 'verHistorial'])->name('pacientes.historial');

    Route::resource('pacientes', PacienteController::class)
        ->middleware(CheckAnyPermission::class . ':pacientes,dentista.pacientes')
        ->names('pacientes');

    // Rutas de consultorios, especialidades y doctores
    Route::resource('consultorios', ConsultorioController::class)->names('consultorios');
    Route::resource('especialidades', EspecialidadController::class)->names('especialidades');
    Route::resource('doctores', DoctorController::class)->names('doctores');

    // Rutas de generación de reportes
    Route::get('/reporte-citas', [CitaMedicaController::class, 'generarReporte'])->name('reporte-citas');
    Route::get('/reporte-pacientes', [PacienteController::class, 'generarReporte'])->name('reporte-pacientes');
    Route::get('/reporte-doctores', [DoctorController::class, 'generarReporte'])->name('reporte-doctores');

    // Rutas de API
    Route::get('/api/pacientes', [CitaMedicaController::class, 'buscarPacientes'])->name('api.pacientes');
    Route::get('/api/doctores', [CitaMedicaController::class, 'buscarDoctores'])->name('api.doctores');
    Route::get('/api/tipos_cita', [CitaMedicaController::class, 'buscarTiposCita'])->name('api.tipos_cita');
    Route::get('/api/consultorios', [CitaMedicaController::class, 'buscarConsultorios'])->name('api.consultorios');

    // Ruta de inicio para usuarios autenticados
    Route::get('/home', [HomeController::class, 'index']);
});

// Ruta de inicio pública
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();
