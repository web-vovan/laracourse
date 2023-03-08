<?php

namespace App\ViewModels;

use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class CatalogViewModel extends ViewModel
{
    public Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function products(): LengthAwarePaginator
    {
        return Product::search(request('search'))
            ->query(function(Builder $query) {
                $query
                    ->select(['id', 'title', 'slug', 'price', 'thumbnail', 'json_properties'])
                    ->withCategory($this->category)
                    ->filtered()
                    ->sorted();
            })
            ->paginate(6);
    }

    public function categories(): Collection|array
    {
        return Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();
    }
}
