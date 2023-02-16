<?php

namespace Tests\Feature\App\HTTP\Controllers\Auth;

use App\Http\Controllers\Auth\SignUpController;
use App\Listeners\SendEmailNewUserListener;
use App\Notifications\NewUserNotification;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест показа страницы с регистрацией
     */
    public function test_registered_page(): void
    {
        $response = $this->get(
            action([SignUpController::class, 'register']),
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
            action([SignUpController::class, 'register']),
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
}
