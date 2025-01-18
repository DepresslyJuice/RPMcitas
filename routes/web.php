<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgendaCitaController;

Route::get('/agenda', [AgendaCitaController::class, 'index'])->name('agenda.index');



Route::get('/', function () {
    return view('welcome');
});
