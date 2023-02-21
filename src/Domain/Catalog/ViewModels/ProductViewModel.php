<?php

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

class ProductViewModel
{
    use Makeable;

    public function homePage(): Collection|array
    {
        return Cache::rememberForever('product_home_page', function() {
            return Product::query()
                ->homePage()
                ->get();
        });
    }

    public function all(): Collection|array
    {
        return Product::all();
    }
}
