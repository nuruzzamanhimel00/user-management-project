<?php

namespace App\View\Components\Post;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Index extends Component
{
    public $user;
    public $type;

    // protected $except = ['type', 'except'];

    /**
     * Create a new component instance.
     */
    public function __construct($user, $type)
    {
        $this->user = $user;
        $this->type = $type;
    }

    public function except($post, $limit){
        return Str::limit($post, $limit);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post.index');
    }
}
