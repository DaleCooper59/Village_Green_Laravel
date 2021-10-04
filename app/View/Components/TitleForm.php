<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TitleForm extends Component
{
    public $TitleForm;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($TitleForm)
    {
        $this->TitleForm = $TitleForm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.title-form');
    }
}
