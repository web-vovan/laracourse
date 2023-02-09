<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param AuthenticateRequest $request
     * @return RedirectResponse
     */
    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated()) === false) {
            return back()->withErrors([
                'email' => 'Неправильно указан логин или пароль',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('home');
    }

    public function forgotPage()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function passwordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordUpdate(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('message', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
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
