<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filmBanner extends Component
{
    public $films;

    public function __construct($films)
    {
        $this->films = $films;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filmBanner');
    }
}
