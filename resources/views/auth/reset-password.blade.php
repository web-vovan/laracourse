@extends('layouts.auth')

@section('title', 'Восстановление пароля')

@section('content')
    <x-forms.auth-form title="Восстановление пароля">
        <form class="space-y-3" action="{{ route('password.update') }}" method="POST">
            @csrf

            <x-forms.text-input
                :isError="$errors->has('email')"
                name="email"
                type="email"
                placeholder="E-mail"
                value="{{ request('email') }}"
                required>
            </x-forms.text-input>

            @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.text-input
                :isError="$errors->has('password')"
                name="password"
                type="password"
                placeholder="Пароль"
                required>
            </x-forms.text-input>

            @error('password')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.text-input
                :isError="$errors->has('password_confirmation')"
                name="password_confirmation"
                type="password"
                placeholder="Повторно пароль"
                required>
            </x-forms.text-input>

            <x-forms.text-input
                name="token"
                type="hidden"
                value="{{ $token }}">
            </x-forms.text-input>

            @error('password_confirmation')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.primary-button type="submit">
                Обновить пароль
            </x-forms.primary-button>
        </form>

        <x-slot:socialAuth>
        </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('register') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-form>
@endsection
