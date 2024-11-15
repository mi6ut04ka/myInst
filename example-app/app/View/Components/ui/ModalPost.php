<?php

namespace App\View\Components\ui;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalPost extends Component
{
    /**
     * Create a new component instance.
     */

    public Post $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.modal-post');
    }
}
