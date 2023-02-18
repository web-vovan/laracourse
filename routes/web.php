<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\Route;

// Auth
Route::group([], base_path('/routes/web/auth.php'));

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->where('file', '.+\.(png|jpg|jpeg)$')
    ->name('thumbnail');

