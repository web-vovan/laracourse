<?php

namespace App\Sorting;

use Domain\Catalog\Sorting\AbstractSorting;

class PriceDescSorting extends AbstractSorting
{
    public function title(): string
    {
        return 'от дорогих к дешевым';
    }

    public function value(): string
    {
        return '-price';
    }
}
