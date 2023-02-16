<?php

use Illuminate\Support\Facades\Route;

// Auth
Route::group([], base_path('/routes/web/auth.php'));

Route::get('/', function () {
    logger()
        ->channel('telegram')
        ->info('hello, world');
    return view('welcome');
})->name('home');

