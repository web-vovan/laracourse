<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'thumbnail' => $this->faker->fixturesImage('images/products', 'images/products'),
            'price' => $this->faker->numberBetween(10000, 900000),
            'quantity' => $this->faker->numberBetween(0, 20),
            'text' => $this->faker->realText(),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'on_home_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
