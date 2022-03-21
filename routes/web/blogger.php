<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloggerController;

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


Route::get('blogger-login-page', function () {
    return view('backend.user.auth.login', ['type' => 'bloggerLogin']);
})->name('blogger-login-page');

Route::get('blogger-dashboard-page', function () {
    return view('backend.user.dashboard');
})->name('blogger-dashboard-page')->middleware('verifySession');

Route::get('get-bloggers', [BloggerController::class, 'index'])->name('get-bloggers')->middleware('verifySession');

Route::prefix('blogger')->group(function () 
{

});