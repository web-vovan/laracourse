<?php

namespace Tests\Unit\Support;

use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Support\ValueObjects\Price;
use Tests\TestCase;

class PriceCastTest extends TestCase
{
    public function test_cast()
    {
        $product = ProductFactory::new()->createOne([
            'price' => 10000
        ]);

        $this->assertInstanceOf(Price::class, $product->price);
    }

}
