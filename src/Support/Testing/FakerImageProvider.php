<?php

namespace Support\Testing;

use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    public function fixturesImage(string $fixturesDir, string $storageDir): string
    {
        if (Storage::exists($storageDir) === false) {
            Storage::createDirectory($storageDir);
        }

        $fileName = $this->generator->file(
            base_path("tests/Fixtures/{$fixturesDir}"),
            storage_path("app/public/{$storageDir}"),
            false
        );

        return '/' . $storageDir . '/' . $fileName;
    }
}
