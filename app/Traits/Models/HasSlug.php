<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->makeSlug();
        });
    }

    public function makeSlug(): void
    {
        $slugText = $this->slug
            ?? Str::slug($this->{self::slugFrom()});

        if ($this->isSlugExists($slugText) === false) {
            $this->slug = $slugText;

            return;
        }

        $i = 1;

        while ($this->isSlugExists($slugText . '-' . $i)) {
            $i++;
        }

        $this->slug = $slugText . '-' . $i;
    }

    public function isSlugExists(string $slug): bool
    {
        return $this::query()
            ->where('slug', $slug)
            ->exists();
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
