<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public int $slugCounter = 1;

    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $slugText = $model->slug
                ?? Str::slug($model->{self::slugFrom()});

            if ($model::query()
                ->where('slug', $slugText)
                ->exists() === false
            ) {
                $model->slug = $slugText;

                return;
            }

            while ($model::query()
                ->where('slug', $slugText . '-' . $model->slugCounter)
                ->exists()
            ) {
                $model->slugCounter++;
            }

            $model->slug = $slugText . '-' . $model->slugCounter;
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
