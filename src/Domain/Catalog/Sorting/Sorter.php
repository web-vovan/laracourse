<?php

namespace Domain\Catalog\Sorting;

use Illuminate\Database\Eloquent\Builder;

class Sorter
{
    protected array $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function run(Builder $q)
    {
        return $q->when(count($this->items), function (Builder $q) {
            if ($this->sortData() === null) {
                return;
            }

            $direction = str($this->sortData())->contains('-')
                ? 'DESC'
                : 'ASC';

            $q->orderBy(
                str($this->sortData())->remove('-'),
                $direction
            );
        });
    }

    public function sortData(): ?string
    {
        $column = request()->get('sort');

        foreach ($this->items as $item) {
            if ($item === $column) {
                return $item;
            }
        }

        return null;
    }
}
