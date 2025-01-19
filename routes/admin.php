<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\HomeController;

// Ruta principal de administración
Route::get('/', [HomeController::class, 'index'])->name('admin.home');

// Ruta de usuarios
Route::resource('users', UserController::class)->names('admin.users');


// Ruta de roles
Route::resource('roles', RolesController::class)->names('admin.roles');