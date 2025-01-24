<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgendaCitaController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Perfil\PerfilController;




Route::resource('citas', CitaMedicaController::class);
Route::get('/agenda', [AgendaCitaController::class, 'index'])->name('agenda.index');

Route::get('/agenda/dia', [AgendaCitaController::class, 'citasDelDia'])->name('agenda.dia');
Route::get('/agenda/create', [CitaMedicaController::class, 'create'])->name('citas.create');
Route::post('/agenda/store', [AgendaCitaController::class, 'store'])->name('agenda.store');
Route::put('/citas/{id}', [CitaMedicaController::class, 'update'])->name('citas.update');




Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);




Auth::routes();
