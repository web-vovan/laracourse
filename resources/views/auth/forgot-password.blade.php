@extends('layouts.auth')

@section('title', 'Восстановить пароль')

@section('content')
    <x-forms.auth-form title="Восстановить пароль">
        <form class="space-y-3" action="{{ route('password.email') }}" method="POST">
            @csrf

            <x-forms.text-input
                :isError="$errors->has('email')"
                name="email"
                type="email"
                placeholder="E-mail"
                value="{{ old('email') }}"
                required>
            </x-forms.text-input>

            @error('email')
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

            <x-forms.primary-button type="submit">
                Отправить
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
