<?php

namespace App\View\Components;

use Illuminate\View\Component;

class buttonConnexion extends Component
{
    public $action;
    public $path;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $path)
    {
        $this->action = $action;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttonConnexion');
    }
}