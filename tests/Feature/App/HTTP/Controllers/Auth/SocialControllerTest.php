<?php

namespace Tests\Feature\App\HTTP\Controllers\Auth;

use App\Http\Controllers\Auth\SocialiteController;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Mockery\MockInterface;
use Tests\TestCase;

class SocialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_callback()
    {
        $githubId = Str::random(10);

        $user = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($githubId) {
            $mock->shouldReceive('getId')
                ->once()
                ->andReturn($githubId);

            $mock->shouldReceive('getName')
                ->once()
                ->andReturn('vovan');

            $mock->shouldReceive('getEmail')
                ->once()
                ->andReturn(self::TEST_USER_EMAIL);
        });

        Socialite::shouldReceive('driver->user')
            ->once()
            ->andReturn($user);

        $response = $this->get(action([SocialiteController::class, 'callback']));

        $this->assertDatabaseHas('users', [
            'github_id' => $githubId
        ]);

        /** @var User $user */
        $user = User::query()
            ->where('email', self::TEST_USER_EMAIL)
            ->first();

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));
    }
}
