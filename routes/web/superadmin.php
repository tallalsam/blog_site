<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;

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

Route::get('super-admin-login-page', function () {
    return view('backend.user.auth.login', ['type' => 'superadminLogin']);
})->name('super-admin-login-page');

Route::get('superadmin-dashboard-page', function () {
   
        return view('backend.user.dashboard');
})->name('superadmin-dashboard-page')->middleware('verifySession');

Route::prefix('superadmin')->group(function () 
{

});