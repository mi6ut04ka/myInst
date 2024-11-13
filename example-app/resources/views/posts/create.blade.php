<x-layouts.app>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-3xl font-bold mb-8 text-center">Создать пост</h1>


        <form action="{{route('posts.store')}}" enctype="multipart/form-data" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Описание</label>
                <input type="text" name="description" id="description" placeholder="Описание" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Загрузить фотокарточку</label>
                <input accept="image/png,image/jpg,image/jpeg" type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Создать
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

    </div>
</x-layouts.app>
