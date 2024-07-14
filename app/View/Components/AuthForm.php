<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthForm extends Component
{
    public $action, $method;
    /**
     * Create a new component instance.
     */
    public function __construct(string $action, string $method)
    {
      $this->action = $action;
      $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.auth_form');
    }
}
