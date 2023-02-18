<?php

namespace Tests\Feature\App\HTTP\Controllers\Auth;

use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест показа страницы с изменением пароля
     */
    public function test_password_reset_page(): void
    {
        $this->createTestUser();

        $token = Password::createToken($this->testUser);

        $response = $this->get(
            '/reset-password/' . $token,
        );

        $response
            ->assertOk()
            ->assertViewIs('auth.reset-password');
    }

    public function test_password_update(): void
    {
        Notification::fake();
        Event::fake();

        $this->createTestUser();

        $token = app(PasswordBroker::class)->createToken($this->testUser);

        $newPassword = '12341234';

        $request = [
            'email' => self::TEST_USER_EMAIL,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
            'token' => $token
        ];

        $response = $this->post(
            action([ResetPasswordController::class, 'passwordUpdate']),
            $request
        );

        $response->assertValid();

        Event::assertDispatched(PasswordReset::class);

        $response->assertRedirect();
    }
}
