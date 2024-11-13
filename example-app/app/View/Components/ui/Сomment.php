<?php

namespace App\View\Components\ui;

use App\Models\Comment as CommentModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Comment extends Component
{
    /**
     * Create a new component instance.
     */
    public СommentModel $comment;

    public function __construct(СommentModel $comment)
    {
        $this->comment = $comment;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.comment');
    }
}
