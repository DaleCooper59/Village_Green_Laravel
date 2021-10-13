<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class Search extends Component
{
    public $searchTerm;
    public $cities;

    public function render()
    {
        $searchTerm = "%$this->searchTerm%";
        $this->cities = City::where('name','like', $searchTerm )->get();
        return view('livewire.search');
    }
}
