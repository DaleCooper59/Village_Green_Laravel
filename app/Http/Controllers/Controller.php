<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //public $owner; 

    public function __construct(/*$owner*/)
  {
    //its just a dummy data object.
    //$this->owner = $owner;

    // Sharing is caring
    //View::share('owner', $owner);
  }

    public function test(){
        $product = Product::all();
        
        return view('test', compact('product'));
    }
    
}


