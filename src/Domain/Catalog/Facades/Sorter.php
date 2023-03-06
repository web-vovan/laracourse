<?php

namespace Domain\Catalog\Facades;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Facade;

/**
 * Class Sorter
 * @package Domain\Catalog\Facades
 *
 * @method static run(Builder $q)
 * @see \Domain\Catalog\Sorting\Sorter
 */
class Sorter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Domain\Catalog\Sorting\Sorter::class;
    }
}
