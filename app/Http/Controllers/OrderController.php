<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer, Employee $employee, Address $address, Product $products, Request $request)
    {
        if (!empty(Auth::user()->employees->first())) {
            $employee = Auth::user()->employees->first();
        } elseif (!empty(Auth::user()->customers->first())) {
            $customer = Auth::user()->customers->first();
        } else {
            return 0;
        }

        $addressEmployee ='';
        $address = $customer->address->first();
        if(isset($employee->company->address)){
            $addressEmployee = $employee->company->address->first();
        }
        

        $rows = Cart::content();
        if (!empty($request->code)) {
            $str = substr($request->code, -2);
            $reduction = intval($str, 10);
        }

        $totals = [];
        foreach ($rows as $row) {
            $totals[] += $row->price * $row->qty;
        }

        $paymentMethod = ['Visa', 'MasterCard', 'Paypal', '4 fois sans frais'];
        $priceWithReduction = number_format(array_sum($totals) * (1 + (19.6 / 100)) * (1 - ($reduction / 100)), 2, '.', '');

        $categoriesParent = Category::where('parent_id', null)->get();
        return view('orders.create', compact('address', 'employee', 'addressEmployee', 'customer', 'products', 'categoriesParent', 'rows', 'reduction', 'priceWithReduction', 'paymentMethod'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $return = redirect()->route('index')->with('success', 'Votre commande à bien été prise en compte');
        //customer?
        $customer = Auth::user()->customers->first();
        
        if (Auth::user()->customers === null) {
           if($customer->type === 'particulier'){
                $amount =  'totalité';
           }else{
               $amount = 'paiement différé';
           }
        }else{
             $amount = 'totalité';
        }
       
        $payDate = $amount === 'totalité' ? Carbon::now() : '';

        $order = Order::create([
            'quantity_total' => Cart::count(),
            'discount' => $request->reduction,
            'extra_discount' => null,
            'tax' => 19.6,
            'amount_paid' => $amount,
            'payment_method' => $request->paymentMethod,
            'payment_date' =>  $payDate,
            'shipping_status' => 'En préparation',
            'shipping_date' => null,
        ]);

        $employee = Auth::user()->employees->first();

    
        if(isset($customer->address)){
            $order->model()->associate($customer)->save();
            $addressPostalStreet = $customer->address->first()->street;
        }else {
            $order->model()->associate($employee)->save();
            $addressPostalStreet = $employee->company->address->first()->street;
        }

        $address = $request->deliveryStreet === $addressPostalStreet ? $addressPostalStreet : $request->deliveryStreet;


        if ($address !== $addressPostalStreet) {
            $find = Address::where('street', $address)->first();
            if ($find !== null) {
                //rue existe dans la bdd
                $city = City::where('name', $find->city->first())->first();
                if ($city !== null && $find->city_id === $city->id) {
                    //ville existe dans la bdd + rue
                    $order->address()->attach($find->id);
                    $order->save();
                    return $return;
                } else {
                    $newCity = City::create([
                        'name' => $request->city,
                        'postal_code' => $request->postal_code,
                    ]);
                    $find->city->associate($newCity);
                    $order->address()->attach($find->id);
                    $order->save();
                    return  $return;
                }
            }/*sinon*/ else {
                $city1 = City::where('name', $request->city)->first();
                $ad = Address::create([
                    'street' => $request->deliveryStreet,
                    'city_id' => $city1->id,
                ]);

                $order->address()->attach($ad->id);
                $order->save();
                return  $return;
            }
        }

        if(isset($customer->address)){
            $order->address()->attach($customer->address->first()->id);
        }else{
            $order->address()->attach($employee->company->address->first()->id);
        }
        

        $order->save();

        foreach (Cart::content() as $row) {
            Cart::remove($row->rowId);
        }

        return  $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
