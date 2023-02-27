<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThumbnailController;
use App\Http\Middleware\CatalogView;
use Illuminate\Support\Facades\Route;

// Auth
Route::group([], base_path('/routes/web/auth.php'));

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/catalog/{category:slug?}', CatalogController::class)
    ->middleware(CatalogView::class)
    ->name('catalog');

Route::get('/product/{product:slug}', [ProductController::class, 'index'])
    ->name('product');

Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->where('file', '.+\.(png|jpg|jpeg)$')
    ->name('thumbnail');

