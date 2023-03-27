<?php

namespace Domain\Auth\DTO;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class NewUserDTO
{
    use Makeable;

    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return static::make(...$request->only(['name', 'email', 'password']));
    }
}
