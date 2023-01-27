<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\OtpController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('admin.')->prefix('/admin')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::put('/login', [LoginController::class, 'store']);

        Route::get('/verify', [OtpController::class, 'store'])->name('verify');
        Route::put('/verify', [OtpController::class, 'store']);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});
