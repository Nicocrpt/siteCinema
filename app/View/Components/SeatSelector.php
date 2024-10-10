<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeatSelector extends Component
{
    public $salle;
    public function __construct($salle)
    {
        $this->salle = $salle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seat-selector');
    }
}
