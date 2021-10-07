<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    public function show(Customer $customer)
    {
        $address = $customer->address->first();
        $city = $address->city;
        $birth =implode('.',array_reverse(explode('-',$customer->user->birth)));
        
        $categoriesParent = Category::where('parent_id', null)->get();
        return view('customers.show', compact('customer', 'categoriesParent', 'address', 'city', 'birth'));
    }

}
