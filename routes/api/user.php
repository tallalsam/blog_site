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

Route::post('user/login',[LoginController::class, 'userLogin'])->name('userLogin');
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here 

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