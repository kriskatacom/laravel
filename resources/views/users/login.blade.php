@extends("layouts.app")

@section("content")
    <div class="max-w-[768px] mx-auto text-center py-5 text-lg">
        <h1 class="text-3xl font-bold mb-5">
            Вход в профила
        </h1>

        <p>
            Влез в профила си, за да кандидатстваш за обяви, следиш статусите на своите кандидатури и получаваш
            персонализирани предложения за работа.
        </p>
    </div>

    <div class="max-w-[768px] mx-auto bg-white border border-gray-300 rounded p-10 text-lg">
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="/users/login" method="POST">
            @csrf

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
                <button type="submit" class="primary-button">Влизане в профила</button>
            </div>

            <div>
                <span>Все още нямате профил?</span>
                <a href="/users/register" class="page-link">Регистрация</a>
            </div>
            <div>
                <span>Не помните паролата си?</span>
                <a href="/users/password-reset" class="page-link">Забравена парола</a>
            </div>
        </form>
    </div>
@endsection
