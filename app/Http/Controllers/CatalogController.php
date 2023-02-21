<?php

namespace App\Http\Controllers;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Catalog\Models\Product;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Domain\Catalog\ViewModels\ProductViewModel;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        $brands = Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get();

        $categories = Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();

        $products = Product::query()
            ->select(['id', 'title', 'price', 'thumbnail'])
            ->when($category->exists, function (Builder $query) use ($category) {
                $query->whereRelation(
                    'categories',
                    'categories.id',
                    '=',
                    $category->id
                );
            })
            ->filtered()
            ->sorted()
            ->paginate(6);

        return response()->view('catalog.index', compact([
            'brands',
            'categories',
            'category',
            'products',
        ]));
    }
}
