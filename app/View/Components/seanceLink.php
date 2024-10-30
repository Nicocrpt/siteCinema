<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class seanceLink extends Component
{
    /**
     * Create a new component instance.
     */

    public $seance;
    public function __construct($seance)
    {
        $this->seance = $seance;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seance-link');
    }
}
