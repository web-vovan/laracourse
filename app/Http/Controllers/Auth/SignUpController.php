<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTO\NewUserDTO;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Регистрация на сайте
 *
 * Class SignInController
 * @package App\Http\Controllers\Auth
 */
class SignUpController extends Controller
{
    public function page(): Factory|View|Application
    {
        return view('auth.register');
    }

    public function register(StoreRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        $user = $action(NewUserDTO::fromRequest($request));

        auth()->login($user);

        return redirect()->route('home');
    }
}
