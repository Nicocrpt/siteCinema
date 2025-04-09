<?php

namespace App\View\Components\auth;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class registerForm extends Component
{
    /**
     * Create a new component instance.
     */

    public $loginLink ;
    public $clickAction ;
    
    public function __construct($loginLink = '', $clickAction = null)
    {
        $this->loginLink = $loginLink;
        $this->clickAction = $clickAction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.register-form');
    }
}
