<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class seat extends Component
{
    public $seat ;

    public function __construct($seat)
    {
        return $this->seat = $seat;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seat');
    }
}
