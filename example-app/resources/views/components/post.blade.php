<div class="w-full mb-4">
    <div class="flex items-center py-3">
        <img class="h-10 w-10 rounded-full" src="{{ $post->owner->avatars ? asset('storage/' . $post->owner->avatars->path) : asset('storage/images/default-avatar.png') }}"/>
        <div class="ml-3">
            <b class="text-sm font-semibold">{{ $post->owner->username }}</b>
            <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
        </div>
        @if(!$post->owner->followers->contains(Auth::user()) && $post->owner->id !== Auth::user()->id)
            <form class="ml-auto" data-owner-id="{{ $post->owner->id }}">
                <button type="button" class="text-blue-500 follow-button" data-user-id="{{ $post->owner->id }}">Подписаться</button>
            </form>
        @endif
    </div>

    @if ($post->photos->isNotEmpty())
        <img
            style="max-height: 800px"
             src="{{ asset('storage/' . $post->photos->first()->path) }}"
            alt="Пост"
            class="w-full object-cover">
    @endif

    <div class="p-4">
        <div class="flex items-center  space-x-4 mb-2">
            <a href="/" class="focus:outline-none">
                <img src="{{ asset('storage/icons/comment-icon.svg') }}" alt="Comment" class="h-5 w-5">
            </a>
                <img src="{{ asset('storage/icons/repost-icon.svg') }}" alt="Repost" class="h-5 w-5">
            </button>
            <form class="like-form h-5 w-5" data-post-id="{{ $post->id }}">
            @csrf
            <button type="button" class="focus:outline-none like-button">
                <img
                    src="{{ $post->likes()->where('user_id', \Auth::id())->exists() ?
                    asset('storage/icons/like-icon.svg') : asset('storage/icons/unlike-icon.svg') }}"
                    alt="Like">
            </button>
            </form>
            @if($post->likes->count() !== 0)
                <div>{{$post->likes->count()}}</div>
            @endif
        </div>

        <p class="text-sm">
            <b>{{ $post->owner->username }}:</b>
            {{ $post->content }}
        </p>
        @if($post->comments->count())
            <div>
                <button class="vision-all text-sm" >Посмотреть все комментарии ({{ $comments->count() }})</button>
            </div>
        @endif
        <div class="comment-list mt-2">
            @foreach($comments as $comment)
                <x-ui.comment :comment="$comment" />
            @endforeach
        </div>

        <form data-post-id-form="{{ $post->id }}" class="mt-3 comment-from flex">
            @csrf
            <textarea
                name="content"
                rows="1"
                class="block flex-grow border-0 outline-none resize-none px-2 py-1"
                placeholder="Добавить комментарий..."
                style="max-height: 100px; overflow-y: auto;"></textarea>
            <button
                type="submit"
                class="send-button text-blue-400 font-semibold px-2 hidden"
            disabled>
            Опубликовать
            </button>
        </form>
    </div>
    <hr>
</div>

