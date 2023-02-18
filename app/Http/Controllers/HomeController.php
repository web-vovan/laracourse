<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Domain\Auth\Contracts\RegisterNewUserContract;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::homePage()->get();

        $products = Product::homePage()->get();

        $categories = Category::homePage()->get();

        return view('index', compact([
            'brands',
            'products',
            'categories'
        ]));
    }
}
