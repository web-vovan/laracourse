<?php

namespace Domain\Auth\Actions;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTO\NewUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTO $user): User
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt($user->password),
        ]);

        event(new Registered($user));

        return $user;
    }
}
