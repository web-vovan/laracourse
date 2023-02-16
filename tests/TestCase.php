<?php

namespace Tests;

use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public const TEST_USER_EMAIL = 'test@mail.ru';
    public const TEST_USER_PASSWORD = 123123123;

    public ?User $testUser = null;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    /**
     * Создание тестового пользователя
     */
    public function createTestUser()
    {
        $this->testUser = User::create([
            'name' => 'test',
            'email' => self::TEST_USER_EMAIL,
            'password' => bcrypt(self::TEST_USER_PASSWORD),
        ]);
    }
}
