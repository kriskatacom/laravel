@extends("layouts.app")

@section("content")
    <h2 class="text-2xl text-center py-10">Смяна на паролата</h2>

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

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
    
            <div class="mb-4">
                <label class="block text-gray-700">Имейл</label>
                <input type="email" name="email" value="{{ $email }}" class="form-control">
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700">Нова парола</label>
                <input type="password" name="password" class="form-control">
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label class="block text-gray-700">Потвърди паролата</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="primary-button">Смени паролата</button>
            </div>
        </form>
    </div>
@endsection