<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

    Route::get('panel/users', [UserController::class, 'list']);
    Route::get('panel/users/add', [UserController::class, 'add']);
    Route::post('panel/users/add', [UserController::class, 'insert']);
    Route::get('panel/users/edit/{id}', [UserController::class, 'edit']);
    Route::post('panel/users/edit/{id}', [UserController::class, 'update']);
    Route::get('panel/users/delete/{id}', [UserController::class, 'delete']);
//    end users
    Route::get('panel/blog/category/', [CategoryController::class, 'list']);
    Route::get('panel/blog/category/add', [CategoryController::class, 'add']);
    Route::post('panel/blog/category/add', [CategoryController::class, 'insert']);
    Route::get('panel/blog/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('panel/blog/category/edit/{id}', [CategoryController::class, 'update']);
    Route::get('panel/blog/category/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('panel/blog/posts/', [PostController::class, 'list']);
    Route::get('panel/blog/posts/add', [PostController::class, 'add']);
    Route::post('panel/blog/posts/add', [PostController::class, 'insert']);
    Route::get('panel/blog/posts/edit/{id}', [PostController::class, 'edit']);
    Route::post('panel/blog/posts/edit/{id}', [PostController::class, 'update']);
    Route::get('panel/blog/posts/delete/{id}', [PostController::class, 'delete']);
//    end blog
});
