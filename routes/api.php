<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // * rutas login
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
});