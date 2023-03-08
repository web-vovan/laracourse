<?php

namespace App\ViewModels;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function brands(): Collection|array
    {
        return  Cache::rememberForever('brand_home_page', function() {
            return Brand::query()
                ->homePage()
                ->get();
        });
    }

    public function products(): Collection|array
    {
        return Cache::rememberForever('product_home_page', function() {
            return Product::query()
                ->homePage()
                ->get();
        });
    }

    public function categories(): Collection|array
    {
        return Cache::rememberForever('category_home_page', function() {
            return Category::query()
                ->homePage()
                ->get();
        });
    }
}
