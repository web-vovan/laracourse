<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Domain\Auth\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

/**
 * Авторизация через github
 *
 * Class SignInController
 * @package App\Http\Controllers\Auth
 */
class SocialiteController extends Controller
{
    public function redirect(string $driver): RedirectResponse
    {
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Throwable $e) {
            throw new \DomainException('Не найден драйвер');
        }
    }

    public function callback(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();

        /** @var User $user */
        $user = User::query()->updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name ?? $githubUser->nickname,
            'email' => $githubUser->email,
            'password' => Hash::make(Str::random(10)),
        ]);

        Auth::login($user);

        return redirect()->intended(route('home'));
    }
}