<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// ruta publica para product
Route::get('product', [UserController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // * rutas login
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class)->except(['index']);;
});