<?php

namespace App\Menu;

use Support\Traits\Makeable;

class Menu implements \Iterator
{
    use Makeable;

    private int $position = 0;

    private array $data;

    public function __construct()
    {
        $this->data = config('menu');
    }

    public function current()
    {
        return $this->data[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }
}
