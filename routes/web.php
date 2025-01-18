<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgendaCitaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::get('/agenda', [AgendaCitaController::class, 'index'])->name('agenda.index');

Route::get('/agenda/dia', [AgendaCitaController::class, 'citasDelDia'])->name('agenda.dia');

Route::get('/agenda/create', [AgendaCitaController::class, 'create'])->name('agenda.create');
Route::post('/agenda/store', [AgendaCitaController::class, 'store'])->name('agenda.store');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
