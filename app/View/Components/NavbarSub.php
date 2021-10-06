<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavbarSub extends Component
{
    public $categoriesParent;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categoriesParent)
    {
        $this->categoriesParent = $categoriesParent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar-sub');
    }
}
