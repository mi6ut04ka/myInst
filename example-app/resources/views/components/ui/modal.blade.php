<div id="modal-{{$id}}" class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white w-full max-w-md max-h-[80vh] p-4 rounded-lg shadow-lg overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4 text-center">{{ $title }}</h2>
        <ul class="divide-y divide-gray-200">
            @foreach($items as $item)
                <li class="flex justify-between items-center py-3">
                    <div class="flex items-center">
                        <img src="{{ $item->avatars ? asset('storage/' . $item->avatars->path) : asset('storage/images/default-avatar.png') }}" alt="Avatar"
                             class="w-10 h-10 rounded-full object-cover">
                        <span class="ml-3 font-semibold">{{ $item->username }}</span>
                    </div>
                    @if(auth()->user()->following->contains($item))
                        <form action="{{ route('unsubscribe', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm">Отписаться</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
        <button id="closeModalBtn-{{ $id }}" class="mt-4 px-4 py-2 w-full">Закрыть</button>
    </div>
</div>
