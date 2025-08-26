@extends("layouts.app")

@section("content")
    <div class="container mx-auto">
        <section class="p-5">
            <div class="bg-white border border-gray-200 rounded p-5 flex items-center gap-5">
                <div class="min-w-[120px] w-[120px] min-h-[120px] h-[120px]">
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                        class="w-full h-full border border-gray-200 rounded-full object-cover">
                </div>
                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl">{{ $category->name }}</h2>
                    <p class="text-lg">{{ $category->description }}</p>
                </div>
            </div>
        </section>
    </div>
@endsection
