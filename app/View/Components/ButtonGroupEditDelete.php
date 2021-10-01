<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonGroupEditDelete extends Component
{
    public $path;
    public $action;
    public $route;
    public $action2;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($path,$action,$route,$action2)
    {
        $this->path = $path;
        $this->action = $action;
        $this->route = $route;
        $this->action2 = $action2;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-group-edit-delete');
    }
}
