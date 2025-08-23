@extends("layouts.app")

@section("content")
    <div class="max-w-[768px] mx-auto text-center py-5 text-lg">
        <h1 class="text-3xl font-bold mb-5">
            Създаване на профил
        </h1>

        <p>
            Създаването на профил е бързо и лесно и ще ти помогне да откриеш най-подходящите обяви за работа за теб. Попълни
            информацията по-долу и стани част от нашата общност от професионалисти и работодатели.
        </p>
    </div>

    <div class="max-w-[768px] mx-auto bg-white border border-gray-300 rounded p-10 text-lg">
        <form action="/users/register" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block mb-2">Име и фамилия</label>
                <input type="text" id="name" name="name" class="form-control">
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block mb-2">Имейл адрес</label>
                <input type="email" id="email" name="email" class="form-control">
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block mb-2">Парола</label>
                <input type="password" id="password" name="password" class="form-control">
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2">Потвърждаване на паролата</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>

            <div class="mb-4">
                <button type="submit" class="primary-button">Създаване на профила</button>
            </div>

            <div>
                <span>Вече имате профил?</span>
                <a href="/users/login" class="page-link">Вход</a>
            </div>
        </form>
    </div>
@endsection
