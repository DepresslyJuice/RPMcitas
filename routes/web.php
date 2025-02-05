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

Route::get('/pacientes/{id}/historial', [PacienteController::class, 'verHistorial'])->name('pacientes.historial');


Route::resource('consultorios', ConsultorioController::class)->names('consultorios');
Route::resource('especialidades', EspecialidadController::class)->names('especialidades');
Route::resource('doctores', DoctorController::class)->names('doctores');
Route::resource('pacientes', PacienteController::class)->names('pacientes');
Route::get('/reporte-citas', [CitaMedicaController::class, 'generarReporte'])->name('reporte-citas');
Route::get('/reporte-pacientes', [PacienteController::class, 'generarReporte'])->name('reporte-pacientes');






Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);


Route::get('/api/pacientes', [CitaMedicaController::class, 'buscarPacientes'])->name('api.pacientes');
Route::get('/api/doctores', [CitaMedicaController::class, 'buscarDoctores'])->name('api.doctores');
Route::get('/api/tipos_cita', [CitaMedicaController::class, 'buscarTiposCita'])->name('api.tipos_cita');
Route::get('/api/consultorios', [CitaMedicaController::class, 'buscarConsultorios'])->name('api.consultorios');


Auth::routes();
