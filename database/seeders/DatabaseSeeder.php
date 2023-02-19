<?php

namespace Database\Seeders;

use Database\Factories\BrandFactory;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Brand::factory(20)->create();

        Category::factory(5)
            ->has(Product::factory(10))
            ->create();
    }
}
