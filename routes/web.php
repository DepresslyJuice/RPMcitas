<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgendaCitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use Illuminate\Support\Facades\Auth;




Route::get('/agenda', [AgendaCitaController::class, 'index'])->name('agenda.index');

Route::get('/agenda/dia', [AgendaCitaController::class, 'citasDelDia'])->name('agenda.dia');
Route::get('admin/users', [HomeController::class, 'index'])->name('admin.users.index');
Route::get('/agenda/create', [AgendaCitaController::class, 'create'])->name('agenda.create');
Route::post('/agenda/store', [AgendaCitaController::class, 'store'])->name('agenda.store');



Route::get('/', function () {
});


Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/roles', [RolesController::class, 'index'])->name('admin.roles.index');




Auth::routes();
