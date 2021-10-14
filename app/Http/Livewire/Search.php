<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;
//use Livewire\WithPagination;

class Search extends Component
{
   // use WithPagination;

    public $search = '';

    public $page = 1;

    public $highlightIndex = 0;

    protected $queryString = [
       
        'search' => ['except' => ''],

        'page' => ['except' => 1],
    ];

    public function incrementHighlight()

    {

      /*  if ($this->highlightIndex === count($this->page) - 1) {

            $this->highlightIndex = 0;

            return;

        }*/

        $this->highlightIndex++;

    }

    public function decrementHighlight()

    {

      /*  if ($this->highlightIndex === 0) {

            
            $this->highlightIndex = count($this->page) - 1;

            return;

        }*/

        $this->highlightIndex--;

    }

    public function updatingSearch()

    {
        $this->reset('search');
        //$this->resetPage();

    }

    public function render()
    {
        
        return view('livewire.search', [
            'cities' => City::where('name','like', '%'.$this->search.'%' )->paginate(20),
        ]);
    }
}
