<x-layouts.app>
    <div class="container mx-auto" id="posts" data-initial-skip="{{ count($posts) }}">
        @foreach ($posts as $post)
            <x-post :post="$post"/>
        @endforeach
    </div>
</x-layouts.app>

