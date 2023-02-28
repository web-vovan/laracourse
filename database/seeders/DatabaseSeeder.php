<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Property;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Catalog\Models\Product;
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

        $properties = Property::factory(5)->create();

        Option::factory(2)->create();

        $optionValues = OptionValue::factory(10)->create();

        Category::factory(5)
            ->has(Product::factory(10)
                ->hasAttached($optionValues)
                ->hasAttached($properties, function() {
                    return [
                        'value' => fake()->word()
                    ];
                })
            )
            ->create();
    }
}
