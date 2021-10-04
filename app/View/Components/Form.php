<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $method;
    public $route;
    public $action;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($method,$route, $action)
    {
        $this->method = $method;
        $this->route = $route;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
