<aside class="w-[350px] min-h-screen bg-white border-r border-gray-200 hidden lg:block">
    <div class="text-2xl text-center pt-4 py-5 border-b border-gray-200">Администрация</div>
    <ul class="text-lg">
        <li class="border-b border-gray-200">
            <a href="/dashboard" class="block py-3 px-5 hover:bg-gray-100">Табло</a>
        </li>
        <li class="border-b border-gray-200">
            <a href="/dashboard/users" class="block py-3 px-5 hover:bg-gray-100">Потребители</a>
        </li>
        <li class="border-b border-gray-200">
            <a href="/dashboard/categories" class="block py-3 px-5 hover:bg-gray-100">Категории</a>
        </li>
        <li class="border-b border-gray-200">
            <a href="{{ route('dashboard.jobs.index') }}" class="block py-3 px-5 hover:bg-gray-100">Обяви</a>
        </li>
        <li class="border-b border-gray-200 flex items-center">
            <a href="/dashboard/settings" class="block py-3 px-5 hover:bg-gray-100">Настройки</a>
            <span class="bg-gray-200 rounded-full pb-1 px-2">скоро</span>
        </li>
    </ul>
</aside>
