<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaginationController;
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

    Route::get('panel/users', [AdminController::class, 'users_list']);
    Route::get('panel/users/add', [AdminController::class, 'add_user']);
    Route::post('panel/users/add', [AdminController::class, 'insert_user']);
    Route::get('panel/users/edit/{id}', [AdminController::class, 'edit_user']);
    Route::post('panel/users/edit/{id}', [AdminController::class, 'update_user']);
    Route::get('panel/users/delete/{id}', [AdminController::class, 'delete_user']);
//    end users
    Route::get('panel/blog/category/', [AdminController::class, 'category_list']);
    Route::get('panel/blog/category/add', [AdminController::class, 'category_add']);
    Route::post('panel/blog/category/add', [AdminController::class, 'category_insert']);
    Route::get('panel/blog/category/edit/{id}', [AdminController::class, 'category_edit']);
    Route::post('panel/blog/category/edit/{id}', [AdminController::class, 'category_update']);
    Route::get('panel/blog/category/delete/{id}', [AdminController::class, 'category_delete']);

    Route::get('panel/blog/posts/', [AdminController::class, 'posts_list']);
    Route::get('panel/blog/posts/add', [AdminController::class, 'post_add']);
    Route::post('panel/blog/posts/add', [AdminController::class, 'post_insert']);
    Route::get('panel/blog/posts/edit/{id}', [AdminController::class, 'post_edit']);
    Route::post('panel/blog/posts/edit/{id}', [AdminController::class, 'post_update']);
    Route::get('panel/blog/posts/delete/{id}', [AdminController::class, 'post_delete']);
//    end blog
});
