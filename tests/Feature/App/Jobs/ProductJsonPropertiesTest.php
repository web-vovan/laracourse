<?php

namespace Tests\Feature\App\Jobs;

use App\Jobs\ProductJsonProperties;
use App\Models\Property;
use Domain\Catalog\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProductJsonPropertiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_created_json_properties()
    {
        $queue = Queue::getFacadeRoot();

        Queue::fake([ProductJsonProperties::class]);

        $properties = Property::factory(10)->create();

        $product = Product::factory()
            ->hasAttached($properties, function() {
                return [
                    'value' => fake()->word()
                ];
            })
            ->createOne();

        $this->assertEmpty($product->json_properties);

        Queue::swap($queue);

        ProductJsonProperties::dispatchSync($product);

        $product->refresh();

        $this->assertNotEmpty($product->json_properties);
    }
}
