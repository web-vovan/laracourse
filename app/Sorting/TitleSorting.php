<?php

namespace App\Sorting;

use Domain\Catalog\Sorting\AbstractSorting;

class TitleSorting extends AbstractSorting
{
    public function title(): string
    {
        return 'наименованию';
    }

    public function value(): string
    {
        return 'title';
    }
}
