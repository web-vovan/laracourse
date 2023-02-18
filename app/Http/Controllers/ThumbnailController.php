<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ThumbnailController extends Controller
{
    public function __invoke(
        string $dir,
        string $method,
        string $size,
        string $file,
    ): BinaryFileResponse
    {
        abort_if(
            in_array($size, config('thumbnail.allowed_size', [])) === false,
            403,
            'Size not allowed'
        );

        $storage = Storage::disk('images');

        $realPath = $dir . '/' . $file;
        $newDirPath = $dir . '/' . $method . '/' . $size;
        $newFilePath = $newDirPath . '/' . $file;

        if ($storage->exists($newDirPath) === false) {
            $storage->makeDirectory($newDirPath);
        }

        if ($storage->exists($newFilePath) === false) {
            $image = Image::make($storage->path($realPath));

            [$w, $h] = explode('x', $size);

            $image->{$method}($w, $h);

            $image->save($storage->path($newFilePath));
        }

        return response()->file($storage->path($newFilePath));
    }
}
