<?php

namespace Domain\Auth\Contracts;

use Domain\Auth\DTO\NewUserDTO;
use Domain\Auth\Models\User;

interface RegisterNewUserContract
{
    public function __invoke(NewUserDTO $user): User;
}
