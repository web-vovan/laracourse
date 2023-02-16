<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Support\Facades\Route;

// Вход на сайт
Route::controller(SignInController::class)->group(function() {
    Route::get('/login', 'page')
        ->middleware('guest')
        ->name('login');

    Route::post('/login', 'authenticate')
        ->middleware(['throttle:auth', 'guest'])
        ->name('authenticate');

    Route::delete('/logout', 'logout')
        ->middleware('auth')
        ->name('logout');
});

// Регистрация на сайте
Route::controller(SignUpController::class)->group(function() {
    Route::get('/register', 'page')
        ->middleware('guest')
        ->name('register');

    Route::post('/register', 'register')
        ->middleware(['throttle:auth', 'guest'])
        ->name('register.action');
});

// Восстановление пароля
Route::controller(ForgotPasswordController::class)->group(function() {
    Route::get('/forgot-password', 'page')
        ->middleware('guest')
        ->name('forgot-password');

    Route::post('/forgot-password', 'forgotPassword')
        ->middleware('guest')
        ->name('password.email');
});

// Указание нового пароля
Route::controller(ResetPasswordController::class)->group(function() {
    Route::get('/reset-password/{token}', 'page')
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', 'passwordUpdate')
        ->middleware('guest')
        ->name('password.update');
});

// Вход через github
Route::controller(SocialiteController::class)->group(function() {
    Route::get('/auth/socialite/{driver}/redirect', 'redirect')
        ->middleware('guest')
        ->name('socialite.redirect');

    Route::get('/auth/socialite/github/callback', 'callback')
        ->middleware('guest')
        ->name('socialite.callback');
});
