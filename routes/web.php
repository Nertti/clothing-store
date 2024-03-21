<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'home']);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'auth_user']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'create_user']);

Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'admin'], function (){
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);
});
