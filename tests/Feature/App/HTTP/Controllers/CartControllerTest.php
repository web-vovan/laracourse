<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\CartController;
use Domain\Cart\CartManager;
use Domain\Product\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CartManager::fake();
    }

    public function test_empty_cart(): void
    {
        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', collect([]));
    }

    public function test_not_empty_cart(): void
    {
        $product = Product::factory()->createOne();

        cart()->add($product);

        $this->get(action([CartController::class, 'index']))
            ->assertOk()
            ->assertViewIs('cart.index')
            ->assertViewHas('items', cart()->items());
    }

    public function test_success_added(): void
    {
        $this->assertEquals(0, cart()->count());

        $product = Product::factory()->createOne();

        $this->post(action([CartController::class, 'add'], $product), [
            'quantity' => 7
        ]);

        $this->assertEquals(7, cart()->count());
    }

    public function test_quantity_change(): void
    {
        $this->assertEquals(0, cart()->count());

        $product = Product::factory()->createOne();

        cart()->add($product);

        $this->assertEquals(1, cart()->count());

        $this->post(action(
            [CartController::class, 'quantity'],
            cart()->items()->first()
            ),
            [
                'quantity' => 3
            ]
        );

        $this->assertEquals(3, cart()->count());
    }

    public function test_success_delete(): void
    {
        $this->assertEquals(0, cart()->count());

        $product = Product::factory()->createOne();

        cart()->add($product);

        $this->assertEquals(1, cart()->count());

        $this->delete(action(
            [CartController::class, 'delete'],
            cart()->items()->first()
        ));

        $this->assertEquals(0, cart()->count());
    }

    public function test_success_truncate(): void
    {
        $this->assertEquals(0, cart()->count());

        $product = Product::factory()->createOne();

        cart()->add($product);

        $this->assertEquals(1, cart()->count());

        $this->delete(action([CartController::class, 'truncate']));

        $this->assertEquals(0, cart()->count());
    }

}
