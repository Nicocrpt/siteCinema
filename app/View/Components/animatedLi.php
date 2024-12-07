<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class animatedLi extends Component
{
    public $content;
    public $href;
    public $show;
    public $delay;
    public function __construct($content, $href, $show, $delay)
    {
        $this->content = $content;
        $this->href = $href;
        $this->show = $show;
        $this->delay = $delay;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.animated-li');
    }
}
