@extends("layouts.app")

@section("content")
    <div class="flex">
        @component("components.dashboard-sidebar")
        @endcomponent
        <div class="w-full">
            <h1 class="mt-4 pb-5 px-5 text-2xl border-b border-gray-300">Редактиране на категория</h1>

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
                
                <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block mb-2">Заглавие</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                            class="form-control">
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2">Описание</label>
                        <textarea name="description" id="description" class="form-control"
                            rows="10">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($category->image_url)
                        <div class="mb-4">
                            <label class="block mb-2">Текуща снимка</label>
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                class="w-32 h-32 object-cover rounded border">
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="image" class="block mb-2">Качи нова снимка</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control"
                            onchange="previewImage(event)">
                        @error('image')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4" id="image-preview-container" style="display: none;">
                        <label class="block mb-2">Преглед на новата снимка</label>
                        <img id="image-preview" class="w-32 h-32 object-cover rounded border">
                    </div>

                    <div class="mb-4">
                        <label for="parent_id" class="block mb-2">Родителска категория</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">-- Без родител --</option>
                            @foreach($categories as $parent)
                                @if($parent->id !== $category->id)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-5">
                        <button type="submit" name="action" value="save" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Запази
                        </button>
                        <button type="submit" name="action" value="save_and_index"
                            class="bg-blue-500 text-white px-4 py-2 rounded">
                            Запази & преглед на всички
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
