<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// rutas publicas
Route::get('product', [ProductController::class, 'index']);
Route::resource('order', OrderController::class);
Route::post('order/orderall', [OrderController::class, 'orderAll']);
Route::resource('order-detail', OrderDetailController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // * rutas login
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class)->except(['index']);;
});