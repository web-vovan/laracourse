<?php

namespace App\Providers;

use Domain\Auth\Providers\AuthServiceProvider;
use Domain\Cart\Providers\CartServiceProvider;
use Domain\Catalog\Providers\CatalogServiceProvider;
use Domain\Product\Providers\ProductServiceProvider;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(
            AuthServiceProvider::class,
        );

        $this->app->register(
            CatalogServiceProvider::class,
        );

        $this->app->register(
            ProductServiceProvider::class,
        );
        $this->app->register(
            CartServiceProvider::class
        );
    }
}
