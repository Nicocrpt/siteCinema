<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class filmsCaroussel extends Component
{
    /**
     * Create a new component instance.
     */
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
        return view('components.films-caroussel');
    }
}
