@extends("layouts.app")

@section("content")
    <div class="max-w-[768px] mx-auto text-center py-5 text-lg">
        <h1 class="text-3xl font-bold mb-5">
            Забравена парола
        </h1>

        <div class="text-lg text-left space-y-5">
            <p class="text-center">
                Не се притеснявай! Можеш лесно да възстановиш достъпа до профила си.
            </p>

            <p class="text-xl">
                Как да възстановиш паролата:
            </p>

            <ol class="ml-10 list-decimal space-y-2">
                <li>Въведи имейл адреса, с който си регистриран.</li>
                <li>Ще получиш линк за нулиране на паролата на имейла си.</li>
                <li>Следвай инструкциите в имейла, за да създадеш нова парола и да влезеш отново в профила си.</li>
            </ol>

            <p>
                <strong>Съвет</strong>: Избери сигурна и уникална парола, за да защитиш профила си.
            </p>
        </div>
    </div>

    <div class="max-w-[768px] mx-auto bg-white border border-gray-300 rounded p-10 text-lg">
        <form action="/users/password-reset" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-2">Имейл адрес</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-4">
                <button type="submit" class="primary-button">Изпращане на линк</button>
            </div>

            <div>
                <span>Спомняте си паролата?</span>
                <a href="/users/login" class="page-link">Вход</a>
            </div>
        </form>
    </div>
@endsection
