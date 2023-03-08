<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\CatalogController;
use Domain\Catalog\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_response()
    {
        $this->get(action(CatalogController::class))
            ->assertOk();

        $category = Category::factory()->createOne();

        $this->get(action(CatalogController::class, $category))
            ->assertOk();
    }
}
