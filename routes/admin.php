<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\HomeController;

// Ruta principal de administración
Route::get('/', [HomeController::class, 'index'])->name('admin.home');

// Ruta de usuarios
Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

// Ruta de roles
Route::get('/roles', [RolesController::class, 'index'])->name('admin.roles.index');
