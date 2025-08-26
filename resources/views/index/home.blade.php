@extends("layouts.app")

@section("content")
    <div class="bg-gray-50">
        <div class="container mx-auto lg:px-20 lg:py-16 flex flex-col-reverse lg:flex-row items-center gap-10">

            <div class="lg:w-1/2 flex flex-col gap-6 max-lg:px-5 pb-10">
                <h1 class="text-4xl sm:text-5xl max-lg:text-center font-bold text-gray-900">
                    Намери работата на мечтите си
                </h1>
                <p class="text-lg text-gray-700 max-lg:text-center">
                    Разглеждай хиляди обяви за работа от различни компании и кандидатствай директно онлайн. Започни новата
                    си кариера още днес!
                </p>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="max-md:mx-auto px-6 py-3 bg-blue-600 text-lg text-white rounded-lg shadow hover:bg-blue-700 transition">
                        Разгледай обявите
                    </a>
                </div>
            </div>

            <div class="lg:w-1/2">
                <img src="{{ asset('images/hero-job-search.png') }}" alt="Job Search" class="w-full lg:rounded-lg shadow-lg">
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <section class="p-5">
            <h2 class="text-3xl text-center mb-5">Категории</h2>
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', ['id' => $category->id]) }}">
                        <div class="bg-white border border-gray-200 rounded p-5 flex gap-5">
                            <div class="min-w-[60px] w-[60px] min-h-[60px] h-[60px]">
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                    class="w-full h-full border border-gray-200 rounded-full object-cover">
                            </div>
                            <div class="flex flex-col gap-2">
                                <h3 class="text-2xl">{{ $category->name }}</h3>
                                <p>{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection