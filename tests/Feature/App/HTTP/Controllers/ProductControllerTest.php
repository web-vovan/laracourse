<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\ProductController;
use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_response()
    {
        $product = Product::factory()->createOne();

        $this->get(action([ProductController::class, 'index'], $product))
            ->assertOk()
            ->assertViewIs('product.index');
    }
}
