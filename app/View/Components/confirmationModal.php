<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class confirmationModal extends Component
{

    public $content;
    public $action;
    public function __construct($content, $action)
    {
        $this->content = $content;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirmation-modal');
    }
}
