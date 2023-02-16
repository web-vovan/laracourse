<?php

namespace Tests\Feature\App\HTTP\Controllers\Auth;

use App\Http\Controllers\Auth\SignInController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест показа страницы с логином
     */
    public function test_login_page(): void
    {
        $response = $this->get(
            action([SignInController::class, 'page']),
        );

        $response
            ->assertOk()
            ->assertViewIs('auth.login');
    }

    /**
     * Тест входа на сайт успешный
     */
    public function test_authenticate_success(): void
    {
        $this->createTestUser();

        $request = [
            'email' => self::TEST_USER_EMAIL,
            'password' => self::TEST_USER_PASSWORD,
        ];

        $response = $this->post(
            action([SignInController::class, 'authenticate']),
            $request
        );

        $response
            ->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->testUser);
    }

    /**
     * Тест входа на сайт неуспешный
     */
    public function test_authenticate_failed(): void
    {
        $this->createTestUser();

        $request = [
            'email' => 'test@mail.ru',
            'password' => '23321',
        ];

        $response = $this->post(
            action([SignInController::class, 'authenticate']),
            $request
        );

        $response->assertInvalid();
    }

    /**
     * Тест выхода из системы
     */
    public function test_logout(): void
    {
        $this->createTestUser();

        auth()->login($this->testUser);

        $this->assertAuthenticatedAs($this->testUser);

        $response = $this->delete(
            action([SignInController::class, 'logout'])
        );

        $response->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
