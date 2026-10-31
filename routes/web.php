<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'rootLogin'])->name('login.form');

Route::prefix('login')->group(function () {
    Route::get('{loginUrl}', [LoginController::class, 'index']);
    // Route::get('recaptcha/{tmp}', [LoginController::class, 'generateReCaptcha'])
    //     ->name('recaptcha');
    Route::post('/', [LoginController::class, 'login'])
        ->name('login');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
