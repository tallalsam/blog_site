<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('admin/login',[LoginController::class, 'adminLogin'])->name('adminLogin');
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:admin'] ],function(){
   // authenticated staff routes here 

    Route::post('get-users-data', [UserController::class, 'usersData'])->name('get-users-data');
    Route::post('add-user', [UserController::class, 'create'])->name('add-user');
    Route::post('get-user', [UserController::class, 'edit'])->name('get-user');
    Route::post('update-user', [UserController::class, 'update'])->name('update-user');
    Route::post('delete-user', [UserController::class, 'destroy'])->name('delete-user');

    Route::post('get-bloggers-data', [BloggerController::class, 'bloggersData'])->name('get-bloggers-data');
    Route::post('add-blogger', [BloggerController::class, 'create'])->name('add-blogger');
    Route::post('get-blogger', [BloggerController::class, 'edit'])->name('get-blogger');
    Route::post('update-blogger', [BloggerController::class, 'update'])->name('update-blogger');
    Route::post('delete-blogger', [BloggerController::class, 'destroy'])->name('delete-blogger');
    Route::post('get-all-bloggers', [BloggerController::class, 'allBloggers'])->name('get-all-bloggers');

    Route::post('get-blogs-data', [BlogController::class, 'blogsData'])->name('get-blogs-data');
    Route::post('add-blog', [BlogController::class, 'create'])->name('add-blog');
    Route::post('get-blog', [BlogController::class, 'edit'])->name('get-blog');
    Route::post('update-blog', [BlogController::class, 'update'])->name('update-blog');
    Route::post('delete-blog', [BlogController::class, 'destroy'])->name('delete-blog');
});