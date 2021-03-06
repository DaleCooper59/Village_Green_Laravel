<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $action;
    public $path;
    public $svg;
    public $p;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $path, $svg ='', $p ='', $icon='')
    {
        $this->action = $action;
        $this->path = $path;
        $this->svg = $svg;
        $this->p = $p;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
