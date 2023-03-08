<?php

namespace App\Http\Controllers;

use Domain\Product\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(Product $product): Factory|View|Application
    {
        $product->load(['optionValues.option']);

        $viewedProducts = null;

        if (session()->has('viewed_products')) {
            $ids = session()->get('viewed_products');

            unset($ids[$product->id]);

            $viewedProducts = Product::query()
                ->whereIn('id', array_values($ids))
                ->get();
        }

        session()->put('viewed_products.' . $product->id, $product->id);

        return view('product.index', [
            'product' => $product,
            'options' => $product->optionValues->keyValues(),
            'viewedProducts' => $viewedProducts
        ]);
    }
}
