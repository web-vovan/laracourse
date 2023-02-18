<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\File;

trait HasThumbnail
{
    /**
     * Название папки с картинками
     *
     * @return string
     */
    abstract protected function getThumbnailDir(): string;

    /**
     * Поле с картинкой у модели
     *
     * @return string
     */
    protected function thumbnailColumn(): string
    {
        return 'thumbnail';
    }

    public function makeThumbnail(string $size, string $method = 'resize'): string
    {
        return route('thumbnail', [
            'method' => $method,
            'dir' => $this->getThumbnailDir(),
            'size' => $size,
            'file' => File::basename($this->{$this->thumbnailColumn()}),
        ]);
    }
}
