<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin-login-page', function () {
    return view('backend.user.auth.login', ['type' => 'adminLogin']);
})->name('admin-login-page');

Route::get('admin-dashboard-page', function () {
    return view('backend.user.dashboard');
})->name('admin-dashboard-page')->middleware('verifySession');

Route::get('get-admins', [AdminController::class, 'index'])->name('get-admins')->middleware('verifySession');

Route::prefix('admin')->group(function () 
{

});