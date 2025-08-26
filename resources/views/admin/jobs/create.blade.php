@extends("layouts.app")

@section("content")
    <div class="flex">
        @component("components.dashboard-sidebar")
        @endcomponent
        <div class="w-full">
            <h1 class="mt-4 pb-5 px-5 text-2xl border-b border-gray-300">Създаване на обява</h1>

            <div class="bg-white text-lg rounded border border-gray-200 p-5 pt-4 m-5 mt-4">
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
                
                <form action="{{ route('dashboard.jobs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block mb-2">Заглавие</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2">Описание</label>
                        <textarea name="description" id="description" class="form-control" rows="10">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="company" class="block mb-2">Компания</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}" class="form-control">
                        @error('company')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block mb-2">Местоположение</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" class="form-control">
                        @error('location')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="salary" class="block mb-2">Заплата</label>
                        <input type="number" id="salary" name="salary" value="{{ old('salary') }}" class="form-control">
                        @error('salary')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="job_type" class="block mb-2">Тип работа</label>
                        <select id="job_type" name="job_type" class="form-control">
                            <option value="Full-time" {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('job_type')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block mb-2">Качи снимка</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control" onchange="previewImage(event)">
                        @error('image')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4" id="image-preview-container" style="display: none;">
                        <label class="block mb-2">Преглед на снимката</label>
                        <img id="image-preview" class="w-32 h-32 object-cover rounded border">
                    </div>

                    <div class="flex gap-5">
                        <button type="submit" name="action" value="save" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Създай
                        </button>
                        <button type="submit" name="action" value="save_and_index" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Създай & преглед на всички
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection