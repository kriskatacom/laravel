@extends("layouts.app")

@section("content")
    <div class="flex">
        @component("components.dashboard-sidebar")
        @endcomponent

        <div class="w-full">
            <h1 class="mt-4 pb-5 px-5 text-2xl border-b border-gray-300">Категории</h1>

            <div class="p-5 text-lg">
                @if(session('success'))
                    <div class="mb-5 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="w-full border-collapse border border-gray-300 text-left">
                    <thead class="bg-white">
                        <tr>
                            <th class="font-medium border border-gray-300 px-4 py-2">ID</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Име</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Създадена на</th>
                            <th class="text-right font-medium border border-gray-300 px-4 py-2">Опции</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count() > 0)
                            @foreach($categories as $category)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $category->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $category->created_at->translatedFormat('d F Y, H:i') }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">
                                        <x-action-dropdown :model="$category" route-prefix="dashboard.categories" />
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white hover:bg-gray-50">
                                <td colspan="3" class="text-center text-gray-600 px-4 py-2">Няма намерени потребители.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection