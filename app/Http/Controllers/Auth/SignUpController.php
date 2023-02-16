<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
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
        $action($request->validated());

        return redirect()->route('home');
    }
}
