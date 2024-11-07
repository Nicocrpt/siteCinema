<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class toolTip extends Component
{
    public $toolTip;
    public function __construct($toolTip)
    {
        $this->toolTip = $toolTip;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.tool-tip');
    }
}
