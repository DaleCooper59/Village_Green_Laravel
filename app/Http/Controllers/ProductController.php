<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $products){
       
        $products = Product::all();
        $categories = Category::all();
        return view('index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //$comments = $product->comments;
 
        //$user = $product->comments->pluck('users.username')->first();
     
        return view('products.show', [
            'product' => $product,
            //'comments' => $comments, 
            //'username' => $user === null ? '' : $user
        ]);
    }
}
