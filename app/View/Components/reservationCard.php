<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class reservationCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $reservation;
    public $status;
    public function __construct($reservation, $status)
    {
        $this->reservation = $reservation;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reservation-card');
    }
}
