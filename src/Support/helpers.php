<?php

use Domain\Cart\CartManager;
use Domain\Catalog\Filters\FilterManager;
use Domain\Catalog\Models\Category;
use Support\Flash\Flash;

if (!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if (!function_exists('filters')) {
    function filters(): array
    {
        return app(FilterManager::class)->items();
    }
}

if (!function_exists('is_catalog_view')) {
    function is_catalog_view(string $type): bool
    {
        return session('catalog-view', 'grid') === $type;
    }
}

if (!function_exists('filter_url')) {
    function filter_url(?Category $category, array $params = []): string
    {
        return route('catalog', [
            ...request()->only(['filters', 'sort']),
            ...$params,
            'category' => $category
        ]);
    }
}

if (!function_exists('cart')) {
    function cart(): CartManager
    {
        return app(CartManager::class);
    }
}
