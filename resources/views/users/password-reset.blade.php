@extends("layouts.app")

@section("content")
    <h1 class="text-3xl py-10 text-center">
        Забравена парола
    </h1>

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

        <form action="/users/password-reset" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-2">Имейл адрес</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="primary-button">Изпращане на линк</button>
            </div>

            <div>
                <span>Спомняте си паролата?</span>
                <a href="/users/login" class="page-link">Вход</a>
            </div>
        </form>
    </div>
@endsection
