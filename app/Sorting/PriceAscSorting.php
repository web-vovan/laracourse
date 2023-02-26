<?php

namespace App\Sorting;

use Domain\Catalog\Sorting\AbstractSorting;

class PriceAscSorting extends AbstractSorting
{
    public function title(): string
    {
        return 'от дешевых к дорогим';
    }

    public function value(): string
    {
        return 'price';
    }
}
