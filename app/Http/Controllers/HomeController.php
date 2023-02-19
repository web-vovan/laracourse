<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;

class HomeController extends Controller
{
    public function index()
    {
        $brands = BrandViewModel::make()->homePage();

        $products = Product::homePage()->get();

        $categories = CategoryViewModel::make()->homePage();

        return view('index', compact([
            'brands',
            'products',
            'categories'
        ]));
    }
}
