<div class="flex items-start mb-3 comment hidden">
    <img class="h-8 w-8 rounded-full object-cover mr-3" src="{{ $comment->user->profile_picture ?? 'https://via.placeholder.com/40' }}" alt="Avatar">

    <div class="flex-1">
        <div class="flex justify-between items-center">
            <div class="font-semibold text-sm">{{ $comment->user->username }}</div>
            <small class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</small>
        </div>
        <p class="text-sm">{{ $comment->text }}</p>
    </div>
</div>
