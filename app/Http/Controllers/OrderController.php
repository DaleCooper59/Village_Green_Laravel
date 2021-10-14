<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
    public function create(Address $address, Product $products)
    {
        $rows = Cart::content();
        $categoriesParent = Category ::where('parent_id', null)->get();
        return view('orders.create', compact('address', 'products', 'categoriesParent', 'rows'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $order = Order::create([
            'shipping_date' => 'En préparation',
            'ref' => $request->ref,
            'picture' => $path,
            'description' => $request->description,
            'EAN' => $request->EAN,
            'color' => $request->color,
            'unit_price_HT' => $request->unit_price_HT,
            'supply_ref' => $request->supply_ref,
            'supply_product_name' => $request->supply_product_name,
            'supply_unit_price_HT' => $request->supply_unit_price_HT,
            'stock' => $request->stock,
            'stock_alert' => $request->stock_alert
        ]);

        $product->categories()->attach($request->category);

        return redirect()->route('products.show', $product->id)->with('success', 'Votre produit a bien été ajouté');
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
