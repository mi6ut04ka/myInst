<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME', 'MyInstagram')}}</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    @vite('resources/js/app.js')
    @vite('resources/js/bootstrap.js')
    @vite('resources/css/app.css')
</head>


<body class="font-sans leading-normal tracking-normal">

<div class="min-h-screen flex">
    <!-- Навигация для десктопа -->
    <nav style="width: 220px" class="bg-white border-r h-full fixed top-0 left-0 pt-4 hidden lg:block">
        <div class="flex flex-col h-full">
            <div class="pl-4 mb-8">
                <a class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl" href="{{route('home')}}">
                    {{env('APP_NAME', 'MyInstagram')}}
                </a>
            </div>
            <ul class="list-reset flex flex-col flex-1">
                @php
                    $current_route = Route::currentRouteName();
                @endphp
                @guest
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'auth.login') text-gray-900 font-bold @endif"
                           href="{{route('auth.login')}}">
                            <!-- Иконка для авторизации -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8m16 8v-2a4 4 0 00-4-4H4a4 4 0 00-4 4v2m16-4v-2a4 4 0 00-4-4H8" />
                            </svg>
                            Авторизация
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'auth.register') text-gray-900 font-bold @endif"
                           href="{{route('auth.register')}}">
                            <!-- Иконка для регистрации -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8m16 8v-2a4 4 0 00-4-4H4a4 4 0 00-4 4v2m16-4v-2a4 4 0 00-4-4H8" />
                            </svg>
                            Регистрация
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'posts.create') text-gray-900 font-bold @endif"
                           href="{{route('posts.create')}}">
                            <!-- Иконка для создания -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Создать
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'profile') text-gray-900 font-bold @endif"
                           href="{{route('profile')}}">
                            <!-- Иконка для профиля -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 016 16.338V15a5.002 5.002 0 0110 0v1.338a4 4 0 01.879 1.466M7 7a3 3 0 110-6 3 3 0 010 6zm10 0a3 3 0 110-6 3 3 0 010 6z" />
                            </svg>
                            Профиль
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 text-gray-900" href="{{route('auth.logout')}}">
                            <!-- Иконка для выхода -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m2-6v6m8 2H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10m-4 4l4-4m0 0l-4-4m4 4H10" />
                            </svg>
                            Выйти
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Мобильная навигация -->
    <nav id="mobile-nav" class="w-64 bg-white border-r h-full fixed top-0 left-0 pt-4 hidden lg:hidden">
        <div class=" mt-14 flex flex-col h-full">
            <div class="pl-4 mb-8">
                <a class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl" href="{{route('home')}}">
                    {{env('APP_NAME', 'MyInstagram')}}
                </a>
            </div>
            <ul class="list-reset flex flex-col flex-1">
                <!-- Содержимое для мобильной навигации -->
                @guest
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'auth.login') text-gray-900 font-bold @endif"
                           href="{{route('auth.login')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8m16 8v-2a4 4 0 00-4-4H4a4 4 0 00-4 4v2m16-4v-2a4 4 0 00-4-4H8" />
                            </svg>
                            Авторизация
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'auth.register') text-gray-900 font-bold @endif"
                           href="{{route('auth.register')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8m16 8v-2a4 4 0 00-4-4H4a4 4 0 00-4 4v2m16-4v-2a4 4 0 00-4-4H8" />
                            </svg>
                            Регистрация
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="mb-4">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'posts.create') text-gray-900 font-bold @endif"
                           href="{{route('posts.create')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Создать
                        </a>
                    </li>
                    <li class="mb-4 m">
                        <a class="flex items-center py-2 px-4 @if($current_route === 'profile') text-gray-900 font-bold @endif"
                           href="{{route('profile')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 016 16.338V15a5.002 5.002 0 0110 0v1.338a4 4 0 01.879 1.466M7 7a3 3 0 110-6 3 3 0 010 6zm10 0a3 3 0 110-6 3 3 0 010 6z" />
                            </svg>
                            Профиль
                        </a>
                    </li>
                    <li class="mb-4 m">
                        <a class="flex items-center py-2 px-4 text-gray-900" href="{{route('auth.logout')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m2-6v6m8 2H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v10m-4 4l4-4m0 0l-4-4m4 4H10" />
                            </svg>
                            Выйти
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Контентная область -->
    <div class="lg:ml-64 flex-1 flex justify-center items-start pt-20">
        <div class="container md:max-w-3xl mx-auto px-4 w-full">
            <!-- Кнопка для мобильной навигации -->
            <div class="lg:hidden fixed top-0 left-0 z-20">
                <button id="nav-toggle" class="m-4 p-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-green-500 focus:outline-none">
                    <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>

            @if(session('error'))
                <div class="w-full bg-red-500 text-white rounded-lg py-5 px-8 mb-10">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div class="w-full bg-green-500 text-white rounded-lg py-5 px-8 mb-10">
                    {{session('success')}}
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    // Открытие/закрытие мобильной навигации
    document.getElementById('nav-toggle').onclick = function () {
        var mobileNav = document.getElementById("mobile-nav");
        if (mobileNav.classList.contains("hidden")) {
            mobileNav.classList.remove("hidden");
        } else {
            mobileNav.classList.add("hidden");
        }
    };
</script>

</body>

</html>
