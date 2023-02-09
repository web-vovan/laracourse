<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')
        ->middleware('throttle:auth')
        ->name('authenticate');

    Route::delete('/logout', 'logout')->name('logout');

    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')
        ->middleware('throttle:auth')
        ->name('store');

    Route::get('/forgot-password', 'forgotPage')->name('forgot-password');
    Route::post('/forgot-password', 'forgotPassword')->name('password.email');

    Route::get('/reset-password/{token}', 'passwordReset')->name('password.reset');
    Route::post('/reset-password', 'passwordUpdate')->name('password.update');

    Route::get('/auth/socialite/github/redirect', 'githubRedirect')
        ->name('socialite.github.redirect');

    Route::get('/auth/socialite/github/callback', 'githubCallback')
        ->name('socialite.github.callback');
});
