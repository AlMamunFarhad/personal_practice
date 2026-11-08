<?php

use App\Http\Controllers\User\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Route::prefix('login')->group(function () {
//     Route::get('{loginUrl}', [LoginController::class, 'index']);
//     // Route::get('recaptcha/{tmp}', [LoginController::class, 'generateReCaptcha'])
//     //     ->name('recaptcha');
//     Route::post('/', [LoginController::class, 'login'])
//         ->name('login');
// });

// Route::get('/code/captcha/{tmp}', 'LoginController@captcha')->name('default-captcha');
// Route::get('/', 'LoginController@login')->name('login');
// Route::post('login', 'LoginController@submit');
// Route::get('logout', 'LoginController@logout')->name('logout');
// Route::get('get-login-modal-data', 'LoginController@get_login_modal_data')->name('get-login-modal-data');

// Route::get('sign-up', 'RegisterController@register')->name('sign-up');
// Route::post('sign-up', 'RegisterController@submit');

// Route::get('check/{id}', 'RegisterController@check')->name('check');

// // Customer Default Verify
// Route::post('verify', 'RegisterController@verify')->name('verify');
