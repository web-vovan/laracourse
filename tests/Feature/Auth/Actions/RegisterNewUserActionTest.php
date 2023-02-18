<?php

namespace Tests\Feature\Auth\Actions;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTO\NewUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_user_created(): void
    {
        $dto = NewUserDTO::make(
            'test',
            self::TEST_USER_EMAIL,
            self::TEST_USER_PASSWORD
        );

        $action = app(RegisterNewUserContract::class);

        $user = $action($dto);

        $this->assertInstanceOf(User::class, $user);

        $this->assertDatabaseHas('users', [
            'email' => self::TEST_USER_EMAIL
        ]);
    }
}
