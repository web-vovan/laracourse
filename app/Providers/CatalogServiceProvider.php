<?php

namespace App\Providers;

use App\Filters\BrandFilter;
use App\Filters\PriceFilter;
use App\Sorting\PriceAscSorting;
use App\Sorting\PriceDescSorting;
use App\Sorting\TitleSorting;
use Domain\Catalog\Filters\FilterManager;
use Domain\Catalog\Sorting\SortingManager;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FilterManager::class);
        $this->app->singleton(SortingManager::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app(FilterManager::class)->registerFilters([
            new PriceFilter(),
            new BrandFilter(),
        ]);

        app(SortingManager::class)->registerSorting([
            new PriceAscSorting(),
            new PriceDescSorting(),
            new TitleSorting(),
        ]);
    }
}
