<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + TailwindCSS</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto">
            <nav class="flex justify-between items-center py-5">
                <div class="flex justify-between items-center">
                    <a href="/" class="text-2xl font-bold">Обяви за работа</a>
                    <ul class="ml-5 flex gap-2 text-lg">
                        <li>
                            <a href="/" class="nav-link {{ request()->is('/') ? 'bg-gray-200' : '' }}">Начало</a>
                        </li>
                        @if(Auth::check() && auth()->user()->is_admin)
                            <li>
                                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'bg-gray-200' : '' }}">Администрация</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <ul class="flex gap-2 text-lg">
                    @if (Auth::check())
                        <li>
                            <a href="/users/account" class="nav-link {{ request()->is('users/account') ? 'bg-gray-200' : '' }}">Здравей, {{ Auth::user()->name }}!</a>
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit">Изход</button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="/users/register" class="nav-link {{ request()->is('users/register') ? 'bg-gray-200' : '' }}">Регистрация</a>
                        </li>
                        <li>
                            <a href="/users/login" class="nav-link {{ request()->is('users/login') ? 'bg-gray-200' : '' }}">Вход</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <main>
        @yield('content')
    </main>
</body>

</html>
