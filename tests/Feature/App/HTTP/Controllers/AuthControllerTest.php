<?php

namespace Tests\Feature\App\HTTP\Controllers;

use App\Http\Controllers\AuthController;
use App\Listeners\SendEmailNewUserListener;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест показа страницы с логином
     */
    public function test_login_page(): void
    {
        $response = $this->get(
            action([AuthController::class, 'login']),
        );

        $response
            ->assertOk()
            ->assertViewIs('auth.login');
    }

    /**
     * Тест входа на сайт
     */
    public function test_authenticate(): void
    {
        $password = '123123123';

        /** @var User $user */
        $user = User::query()->create([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => bcrypt($password),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.ru',
        ]);

        $request = [
            'email' => 'test@mail.ru',
            'password' => $password,
        ];

        $response = $this->post(
            action([AuthController::class, 'authenticate']),
            $request
        );

        $response
            ->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Тест показа страницы с регистрацией
     */
    public function test_registered_page(): void
    {
        $response = $this->get(
            action([AuthController::class, 'register']),
        );

        $response
            ->assertOk()
            ->assertViewIs('auth.register');
    }

    /**
     * Тест регистрации
     */
    public function test_store_success(): void
    {
        Notification::fake();
        Event::fake();

        $request = [
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ];

        $response = $this->post(
            action([AuthController::class, 'store']),
            $request
        );

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => $request['email'],
        ]);

        /** @var User $user */
        $user = User::query()
            ->where('email', $request['email'])
            ->first();

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailNewUserListener::class);

        $event = new Registered($user);
        $lister = new SendEmailNewUserListener();
        $lister->handle($event);

        Notification::assertSentTo($user, NewUserNotification::class);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));
    }

    /**
     * Тест показа страницы с восстановлением пароля
     */
    public function test_forgot_page(): void
    {
        $response = $this->get(
            action([AuthController::class, 'forgotPage'])
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

        $password = '123123123';

        /** @var User $user */
        $user = User::query()->create([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => bcrypt($password),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.ru',
        ]);

        $response = $this->post(
            action([AuthController::class, 'forgotPassword']),
            [
                'email' => 'test@mail.ru'
            ]
        );

        Notification::assertSentTo($user, ResetPassword::class);

        $response->assertRedirect();
    }

    /**
     * Тест показа страницы с изменением пароля
     */
    public function test_password_reset_page(): void
    {
        $password = '123123123';

        /** @var User $user */
        $user = User::query()->create([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => bcrypt($password),
        ]);

        $token = app(PasswordBroker::class)->createToken($user);

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

        $password = '123123123';
        $newPassword = '12341234';

        /** @var User $user */
        $user = User::query()->create([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => bcrypt($password),
        ]);

        $token = app(PasswordBroker::class)->createToken($user);

        $request = [
            'email' => 'test@mail.ru',
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
            'token' => $token
        ];

        $response = $this->post(
            action([AuthController::class, 'passwordUpdate']),
            $request
        );

        $response->assertValid();

        Event::assertDispatched(PasswordReset::class);

        $response->assertRedirect();
    }

    /**
     * Тест выхода из системы
     */
    public function test_logout(): void
    {
        $password = '123123123';

        /** @var User $user */
        $user = User::query()->create([
            'name' => 'test',
            'email' => 'test@mail.ru',
            'password' => bcrypt($password),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.ru',
        ]);

        auth()->login($user);

        $this->assertAuthenticatedAs($user);

        $response = $this->delete(
            action([AuthController::class, 'logout'])
        );

        $response->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
