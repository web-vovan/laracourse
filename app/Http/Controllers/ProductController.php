<?php

namespace App\Http\Controllers;

use Domain\Catalog\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(Product $product): Factory|View|Application
    {
        return view('product.index', [
            'product' => $product
        ]);
    }
}
