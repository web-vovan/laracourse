<?php

use App\Models\Brand;
use App\Models\Product;
use App\Services\Telegram\Exception\TelegramBotApiException;
use App\Services\Telegram\TelegramBotApi;
use Illuminate\Support\Facades\Log;
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


    $product = Product::create([
        'title' => 'temporibus aliquam',
        'price' => 123
    ]);


    dd($product);
    return view('welcome');
});
