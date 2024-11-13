<?php

namespace App\View\Components;

use App\Models\Comment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post as PostModel;

class Post extends Component
{

    public PostModel $post;
    public Collection $comments;


    public function __construct(PostModel $post)
    {
        $this->post = $post;
        $this->comments = $post->comments;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post',['comments' => $this->comments]);
    }
}
