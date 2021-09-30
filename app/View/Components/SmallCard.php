<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SmallCard extends Component
{
    public $path;
    public $src;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($path, $src, $name)
    {
        $this->path = $path;
        $this->src = $src;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.small-card');
    }
}
