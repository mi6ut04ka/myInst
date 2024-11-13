<x-layouts.app>
    <div class="container mx-auto mt-10">
        <div class="w-full max-w-xs mx-auto">
            <form action="{{route('auth.login')}}" method="POST"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class=" block text-gray-700 text-sm font-bold mb-2" for="username">
                        Логин
                    </label>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Введите имя пользователя"
                        required
                        autofocus
                    />
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Пароль
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="********"
                        required
                    />
                </div>

                <div class="flex items-center justify-center">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Войти
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
