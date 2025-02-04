<?php

use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/perfil', function (Request $request) {
    return response()->json($request->user());
});


