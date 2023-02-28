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
        $product->load(['optionValues.option']);

        $options = $product->optionValues->mapToGroups(function ($item) {
            return [
                $item->option->title => $item
            ];
        });

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
            'options' => $options,
            'viewedProducts' => $viewedProducts
        ]);
    }
}
