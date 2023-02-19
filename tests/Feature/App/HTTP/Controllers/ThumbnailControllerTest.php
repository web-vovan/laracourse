<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\ThumbnailController;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ThumbnailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_fail()
    {
        $response = $this->get(
            action(ThumbnailController::class, [
                'dir' => 'products',
                'method' => 'resize',
                'size' => '1x1',
                'file' => 'test.jpg',
            ])
        );

        $response->assertStatus(403);
    }

    public function test_success()
    {
        $storage = Storage::disk('images');

        $storage->makeDirectory('tests');

        $faker = app(Generator::class);

        $faker->fixturesImage('images/brands', 'images/tests');

        $testFile = basename($storage->files('tests')[0]);

        $response = $this->get(
            action(ThumbnailController::class, [
                'dir' => 'tests',
                'method' => 'resize',
                'size' => '70x70',
                'file' => $testFile,
            ])
        );

        $response->assertOk();

        $resizeFilePath = storage_path('app/public/images/tests/resize/70x70/' . $testFile);

        $this->assertFileExists($resizeFilePath);

        $storage->deleteDirectory('tests');
    }
}
