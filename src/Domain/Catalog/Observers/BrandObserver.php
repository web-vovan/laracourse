<?php

namespace Domain\Catalog\Observers;

use Domain\Catalog\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    public function clearCache(): void
    {
        Cache::forget('brand_home_page');
    }

    /**
     * Handle the Category "created" event.
     *
     * @param Brand $brand
     * @return void
     */
    public function created(Brand $brand)
    {
        $this->clearCache();
    }

    /**
     * Handle the Brand "updated" event.
     *
     * @param Brand $brand
     * @return void
     */
    public function updated(Brand $brand)
    {
        $this->clearCache();
    }

    /**
     * Handle the Brand "deleted" event.
     *
     * @param Brand $brand
     * @return void
     */
    public function deleted(Brand $brand)
    {
        $this->clearCache();
    }
}
