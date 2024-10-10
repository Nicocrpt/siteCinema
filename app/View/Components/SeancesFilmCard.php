<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeancesFilmCard extends Component
{
    public $film;
    public function __construct($film)
    {
        $this->film = $film;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seances-film-card');
    }
}
