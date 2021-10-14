<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;
//use Livewire\WithPagination;

class SearchCountries extends Component
{
   // use WithPagination;

    public $searchCountries = '';

    public $page = 1;

    public $index = 0;

    protected $queryString = [
       
        'searchCountries' => ['except' => ''],

        'page' => ['except' => 1],
    ];


    public function updatingSearchCountries()

    {
        $this->reset('searchCountries');
        //$this->resetPage();

    }

    public function render()
    {
        
        return view('livewire.search-countries', [
            'countries' => Country::where('name','like', '%'.$this->searchCountries.'%' )->paginate(20),
        ]);
    }
}
