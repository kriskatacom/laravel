@extends("layouts.app")

@section("content")
    <div class="flex">
        @component("components.dashboard-sidebar")
        @endcomponent

        <div class="w-full">
            <div class="mt-4 pb-4 px-5 border-b border-gray-300 flex justify-between items-center gap-5">
                <h1 class="text-2xl">Обяви</h1>
                <form action="{{ route('dashboard.jobs.destroy-all') }}" method="POST"
                    onsubmit="return confirm('Сигурни ли сте, че искате да изтриете тази обява?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger-button">Изриване на всички</button>
                </form>
            </div>

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
                            <th class="font-medium border border-gray-300 px-4 py-2">Заглавие</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Компания</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Локация</th>
                            <th class="font-medium border border-gray-300 px-4 py-2">Създадена на</th>
                            <th class="font-medium text-right border border-gray-300 px-4 py-2">Опции</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($jobs->count() > 0)
                            @foreach($jobs as $job)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $job->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $job->title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $job->company }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $job->location }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $job->created_at->translatedFormat('d F Y, H:i') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">
                                        <x-action-dropdown :model="$job" route-prefix="dashboard.jobs" :actions="['show', 'edit', 'delete']" />
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="bg-white hover:bg-gray-50">
                                <td colspan="4" class="text-center text-gray-600 px-4 py-2">Няма намерени обяви.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection