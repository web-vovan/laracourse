<?php

namespace App\Http\Controllers;

use Domain\Catalog\Models\Product;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Catalog\ViewModels\ProductViewModel;

class HomeController extends Controller
{
    public function index()
    {
        $brands = BrandViewModel::make()->homePage();

        $products = ProductViewModel::make()->homePage();

        $categories = CategoryViewModel::make()->homePage();

        return view('index', compact([
            'brands',
            'products',
            'categories'
        ]));
    }
}
