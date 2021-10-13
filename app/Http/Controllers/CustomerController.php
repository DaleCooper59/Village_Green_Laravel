<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(City $cities, Request $request)
    {
        
        $cities = City::search($request->search)->paginate(15);
        return view('customers.index', compact('cities'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $address = Address::where('name', 'Village Green')->first();
        $particulierCommercial = Employee::where('department', 'Vendeur particulier')->first();
        $proCommercial = Employee::where('department', '!=', 'Vendeur particulier')->random(1);
        $customers = Count(Customer::all()) + 1;
        $clientNumber = 'client#' .  $customers;
        $coef = $request->type === strtolower('particulier') ? 5.6 : 2.2;
        $eID = $request->type === strtolower('particulier') ? $particulierCommercial->id : $proCommercial->id;

        Customer::create([
            'user_id' => Auth::user()->id,
            'address_id' => 3,
            'employee_id' => $eID,
            'ref_customer' =>  $clientNumber,
            'type' => $request->type,
            'coefficient' => $coef,
        ]);

        return redirect()->route('index')->with('success', 'Bravo, c\'est l\'heure du shopping maintenant !');
    }

    public function show(Customer $customer)
    {
        $address = $customer->address->first();
        $city = $address->city;
        $birth =implode('.',array_reverse(explode('-',$customer->user->birth)));
        
        $categoriesParent = Category::where('parent_id', null)->get();
        return view('customers.show', compact('customer', 'categoriesParent', 'address', 'city', 'birth'));
    }

}
