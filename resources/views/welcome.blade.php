<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
    @dump(auth()->user())
    <form action="{{ route('logout') }}" method="POST">
        @csrf

        @method('DELETE')

        <button type="submit">выйти</button>
    </form>
    </body>
</html>
