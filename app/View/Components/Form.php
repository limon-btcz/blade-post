<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $action, $method;
    /**
     * Create a new component instance.
     */
    public function __construct($action, $method)
    {
      $this->action = $action;
      $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.forms.form');
    }
}