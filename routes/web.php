<?php

use App\Http\Controllers\AdminController;
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

    Route::get('panel/users/list', [AdminController::class, 'users_list']);

    Route::get('panel/users/add', [AdminController::class, 'add_user']);
    Route::post('panel/users/add', [AdminController::class, 'insert_user']);
    Route::get('panel/users/edit/{id}', [AdminController::class, 'edit_user']);
    Route::post('panel/users/edit/{id}', [AdminController::class, 'update_user']);

    Route::get('panel/users/delete/{id}', [AdminController::class, 'delete_user']);
});
