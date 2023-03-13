<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Support\SessionRegenerator;

/**
 * Вход на сайт
 *
 * Class SignInController
 * @package App\Http\Controllers\Auth
 */
class SignInController extends Controller
{
    public function page()
    {
        return view('auth.login');
    }

    /**
     * Авторизация
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

        SessionRegenerator::run();

        return redirect()->route('home');
    }

    /**
     * Выход из аккаунта
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        SessionRegenerator::run(fn() => auth()->logout());

        return redirect()->route('home');
    }
}
