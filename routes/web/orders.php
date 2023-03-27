<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Заказы
Route::controller(OrderController::class)
    ->prefix('order')
    ->group(function() {
        Route::get('/', 'index')->name('checkout');
        Route::post('/', 'handle')->name('order.handle');
    });
