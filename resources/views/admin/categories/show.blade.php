@extends("layouts.app")

@section("content")
    <div class="flex">
        @component("components.dashboard-sidebar")
        @endcomponent
        <div class="w-full">
            <h1 class="mt-4 pb-5 px-5 text-2xl border-b border-gray-300">Преглед на категория</h1>

            <div class="bg-white text-lg rounded border border-gray-200 p-5 pt-4 m-5 mt-4">
                <div class="flex items-center gap-5">
                    @if ($category->name)
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                            class="w-[120px] h-[120px] border border-gray-200 rounded-full">
                    @endif

                    <div class="flex flex-col">
                        <div class="text-2xl">{{ $category->name }}</div>
                        <div>{{ $category->created_at->translatedFormat('d F Y, H:i') }}</div>
                    </div>
                </div>
                <div class="mt-4">{{ $category->description }}</div>
                <div class="flex gap-5 mt-4">
                    <a href="{{ route('dashboard.categories.index', $category->id) }}" class="primary-button">
                        Назад
                    </a>
                    <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="warning-button">
                        Редакция
                    </a>
                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST"
                        onsubmit="return confirm('Сигурни ли сте, че искате да изтриете тази категория?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="danger-button">Изтрий категория</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection