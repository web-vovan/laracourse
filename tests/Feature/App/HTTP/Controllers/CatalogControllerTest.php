<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\CatalogController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_response()
    {
        $this->get(action(CatalogController::class))
            ->assertOk();
    }
}
