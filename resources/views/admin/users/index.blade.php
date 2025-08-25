@extends("layouts.app")

@section("content")
    <div class="flex">
        @component("components.dashboard-sidebar")
        @endcomponent

        <div class="w-full">
            <h1 class="mt-4 pb-5 px-5 text-2xl border-b border-gray-300">Потребители</h1>

            <div class="p-5 text-lg">
                <table class="w-full border-collapse border border-gray-300 text-left">
                    <thead class="bg-white">
                        <tr>
                            <th class="font-medium border border-gray-300 px-4 py-2">ID</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Име</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Имейл</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Създаден на</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() > 0)
                            @foreach($users as $user)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->translatedFormat('d F Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white hover:bg-gray-50">
                                <td colspan="4" class="text-center text-gray-600 px-4 py-2">Няма намерени потребители.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection