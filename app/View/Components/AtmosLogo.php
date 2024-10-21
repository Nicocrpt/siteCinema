<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AtmosLogo extends Component
{
    public $width;
    public $class;
    public function __construct($width, $class)
    {
        $this->width = $width;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.atmos-logo');
    }
}
