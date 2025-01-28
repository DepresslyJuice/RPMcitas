<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Perfil\PerfilController;
use App\Http\Controllers\ConsultorioController;



Route::resource('citas', CitaMedicaController::class);

Route::get('/agenda/create', [CitaMedicaController::class, 'create'])->name('citas.create');

Route::put('/citas/{id}', [CitaMedicaController::class, 'update'])->name('citas.update');

Route::resource('consultorios', ConsultorioController::class);




Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);




Auth::routes();
