<div class="relative inline-block text-left">
    <button type="button" onclick="this.nextElementSibling.classList.toggle('hidden')" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Опции
        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div class="z-40 origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button">
        <div class="py-1">
            <a href="{{ route($routePrefix.'.show', $model->id) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Преглед</a>
            <a href="{{ route($routePrefix.'.edit', $model->id) }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Редакция</a>
            <form action="{{ route($routePrefix.'.destroy', $model->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 block w-full text-left px-4 py-2 text-sm hover:bg-red-100" role="menuitem" onclick="return confirm('Сигурни ли сте, че искате да изтриете този запис?')">Изтриване</button>
            </form>
        </div>
    </div>
</div>