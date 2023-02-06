<?php

namespace App\Faker;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    public function localImage(string $dir)
    {
        Storage::createDirectory("/images/{$dir}");

        $fileName = $this->generator->file(
            base_path("/tests/Fixtures/images/{$dir}"),
            storage_path("app/public/images/{$dir}"),
            false
        );

        return '/images/' . $dir . '/' . $fileName;
    }
}
