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

    public function __construct()
  {
    //its just a dummy data object.
    $products = Product::all();

    // Sharing is caring
    View::share('products', $products);
  }

    public function test(){
        $product = Product::all();
        $owner = Company::find(1);
        return view('test', compact('product'));
    }
    
}


