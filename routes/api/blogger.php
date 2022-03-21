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

Route::post('blogger/login',[LoginController::class, 'bloggerLogin'])->name('bloggerLogin');
Route::group( ['prefix' => 'blogger','middleware' => ['auth:blogger-api','scopes:blogger'] ],function(){
   Route::post('get-blogs-data', [BlogController::class, 'blogsData'])->name('get-blogs-data');
    Route::post('add-blog', [BlogController::class, 'create'])->name('add-blog');
    Route::post('get-blog', [BlogController::class, 'edit'])->name('get-blog');
    Route::post('update-blog', [BlogController::class, 'update'])->name('update-blog');
    Route::post('delete-blog', [BlogController::class, 'destroy'])->name('delete-blog');
    
});