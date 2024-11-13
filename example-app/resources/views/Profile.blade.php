<x-layouts.app>
    <div class="container mx-auto pt-20">
        <!-- Профильная шапка -->
        <div class="flex items-center justify-between mb-8 px-4">
            <!-- Аватар -->
            <div class="flex-shrink-0">
                <img id="avatar-preview"
                     src="{{ Auth::user()->avatars ? asset('storage/' . Auth::user()->avatars->path) : asset('storage/images/default-avatar.png') }}"
                     class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover cursor-pointer border border-gray-300"
                     alt="Avatar">
            </div>

            <!-- Информация о пользователе -->
            <div class="flex-grow ml-6">
                <div class="flex items-center justify-between">
                    <!-- Имя пользователя и кнопка редактирования профиля -->
                    <h1 class="text-xl sm:text-2xl font-semibold">{{ Auth::user()->username }}</h1>
                    <button class="ml-4 px-4 py-2 border border-gray-300 rounded text-sm font-semibold">Редактировать профиль</button>
                </div>

                <!-- Статистика: количество постов, подписчиков и подписок -->
                <div class="flex space-x-4 mt-4">
                    <div class="text-center">
                        <span class="font-semibold">{{$posts->count()}}</span>
                        <p class="text-sm text-gray-600">@if($posts->count()== 0)Постов@elseif($posts->count() == 1)Пост@elseif($posts->count() <= 4)Поста@elseПостов@endif</p>
                    </div>
                    <div class="text-center flex-col flex">
                        <span class="font-semibold">{{$user->followers->count()}}</span>
                        <button id="openModalBtn-followers" class="text-sm text-gray-600">Подписчики</button>
                        <x-ui.modal id="followers" title="Подписчики" :items="$user->followers" />
                    </div>
                    <div class="text-center flex-col flex">
                        <span class="font-semibold">{{$user->following->count()}}</span>
                        <button id="openModalBtn-following" class="text-sm text-gray-600">Подписки</button>
                        <x-ui.modal id="following" title="Подписки" :items="$user->following" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Сетка с постами -->
        <div class="grid grid-cols-3 gap-1 sm:gap-4 px-4">
            @foreach ($posts as $post)
                <button data-post="{{$post->id}}" class="relative group">
                    <a href="/" class="block w-full" style="padding-bottom: 100%;"> <!-- Фиксируем квадрат -->
                        <img src="{{ asset('storage/' . $post->photos->first()->path) }}" alt="Post image"
                             class="absolute inset-0 w-full h-full object-cover"> <!-- Изображение покрывает весь блок -->

                        <!-- Накладываемая информация при наведении -->
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white">
                            <div class="flex space-x-4">
                        <span class="flex items-center">
                            <img src="{{ asset('storage/icons/like-icon.svg') }}" class="h-5 w-5 mr-2" alt="Likes">
                            {{ $post->likes->count() }}
                        </span>
                                <span class="flex items-center">
                            <img src="{{ asset('storage/icons/comment-icon.svg') }}" class="h-5 w-5 mr-2" alt="Comments">
                            {{ $post->comments->count() }}
                        </span>
                            </div>
                        </div>
                    </a>
                </button>
            @endforeach
            <x-ui.modal-post :post="$posts[0]"/>
        </div>


        <!-- Форма для загрузки аватара -->
        <form id="avatar-form" action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden">
            @error('avatar')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </form>
    </div>
</x-layouts.app>
