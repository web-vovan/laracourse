<?php

namespace Domain\Catalog\Sorting;

abstract class AbstractSorting
{
    abstract public function title(): string;

    abstract public function value(): string;

    public function isActive(): bool
    {
        return request('sort') === $this->value();
    }
}
