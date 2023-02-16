<?php

namespace Tests\Feature\App\HTTP\Controllers\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест показа страницы с восстановлением пароля
     */
    public function test_forgot_page(): void
    {
        $response = $this->get(
            action([ForgotPasswordController::class, 'page'])
        );

        $response
            ->assertOk()
            ->assertViewIs('auth.forgot-password');
    }

    /**
     * Тест отправки email для восстановления пароля
     */
    public function test_forgot_password()
    {
        Notification::fake();
        Event::fake();

        $this->createTestUser();

        $response = $this->post(
            action([ForgotPasswordController::class, 'forgotPassword']),
            [
                'email' => self::TEST_USER_EMAIL
            ]
        );

        Notification::assertSentTo($this->testUser, ResetPassword::class);

        $response->assertRedirect();
    }
}
