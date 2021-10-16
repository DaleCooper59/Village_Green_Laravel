<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
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
    public function create(Customer $customer, Address $address, Product $products, Request $request)
    {
        
        $customer = Auth::user()->customers->first();
        $address = $customer->address->first();

        $rows = Cart::content();
        if(!empty($request->code)){
            $str = substr($request->code, -2) ; 
            $reduction = intval($str,10);
        }

        $totals= [];
        foreach($rows as $row){
            $totals[] += $row->price * $row->qty;
        }
      
        $paymentMethod = ['Visa', 'MasterCard', 'Paypal', '4 fois sans frais'];
        $priceWithReduction = number_format(array_sum($totals)*(1+(19.6/100)) * (1-($reduction/100)),2,'.','') ;
        
        $categoriesParent = Category ::where('parent_id', null)->get();
        return view('orders.create', compact('address', 'products', 'categoriesParent', 'rows', 'reduction', 'priceWithReduction', 'paymentMethod'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $customer = Auth::user()->customers->first();
        $amount = $customer->type === 'particulier' ? 'totalité' : 'paiement différé';
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
        $order->model()->associate($customer)->save();

        $addressPostalStreet = $customer->address->first()->street;
        $address = $request->deliveryStreet === $addressPostalStreet ? $addressPostalStreet : $request->deliveryStreet;
        // a finir !!!!!!!!!!!!!!!!!
        if($address !== $addressPostalStreet){
            $find = Address::where('street', $address)->first();
            if($find !== null){
                $city = City::where('name', $find->city->first())->first();
               if($city !== null){
                $order->address()->attach($find->id);
               }
            }else{
                //city_id?,,
                $ad = Address::create([
                    'street' => $request->deliveryStreet,
                ])
            }
        }
        
        $order->address()->attach($customer->address->first()->id);

        $order->save();
        return redirect()->route('index')->with('success', 'Votre commande à bien été prise en compte');
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
