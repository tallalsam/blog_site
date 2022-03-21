<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('user-login-page', function () {
    return view('backend.user.auth.login', ['type' => 'userLogin']);
})->name('user-login-page');

Route::get('user-dashboard-page', function () {
    return view('backend.user.dashboard');
})->name('user-dashboard-page')->middleware('verifySession');

Route::get('get-users', [UserController::class, 'index'])->name('get-users')->middleware('verifySession');

Route::prefix('user')->group(function () 
{

});