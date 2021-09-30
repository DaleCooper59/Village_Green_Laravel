<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(Product $products, Category $categories){
       
        $categoriesParent =  Category::whereNull('parent_id')->with('children')->get();
        
        return view('index', compact('products', 'categories', 'categoriesParent'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $categories)
    {
        
        $categories = Category::all();
        $categoriesChild = $categories->where('parent_id', !null);

        return view('products.create', compact('categories', 'categoriesChild'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'label' => ['required', 'max:255'],
            'ref' => ['required', 'max:45'],
            'picture' => ['required', 'file'],
            'description' => ['required'],
            'EAN' => ['required', 'unique:products', 'max:45'],
            'color' => ['required', 'max:45'],
            'unit_price_HT' => ['required', 'numeric'],
            'supply_ref' => ['required', 'max:45', 'different:ref'],
            'supply_product_name' => ['required', 'max:45'],
            'supply_unit_price_HT' => ['required', 'numeric', 'lt:unit_price_HT'],
            'stock' => ['required', 'numeric'],
            'stock_alert' => ['required', 'numeric', 'lt:stock'],
        ]);

        
        $path = $request->picture->storeAs(
            'pictures',
            time() . '.' . $request->picture->extension(),
            'public'
        );


        $product = Product::create([
                'label' => $request->label,
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
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {
        return view('products.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $categoriesChild = $categories->where('parent_id', !null);
        return view('products.edit', compact('product', 'categories', 'categoriesChild'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        
        $request->validate([
            'label' => ['required', 'max:255'],
            'ref' => ['required', 'max:45'],
            'picture' => ['required', 'file'],
            'description' => ['required'],
            'EAN' => ['required', 'unique:products', 'max:45'],
            'color' => ['required', 'max:45'],
            'unit_price_HT' => ['required', 'numeric'],
            'supply_ref' => ['required', 'max:45', 'different:ref'],
            'supply_product_name' => ['required', 'max:45'],
            'supply_unit_price_HT' => ['required', 'numeric', 'lt:unit_price_HT'],
            'stock' => ['required', 'numeric'],
            'stock_alert' => ['required', 'numeric', 'lt:stock'],
        ]);

        if($request->file){
            $path = $request->file('picture')->storeAs(
            'pictures',
            time() . '.' . $request->picture->extension(),
            'public'
        );
        }else{
            $path='no';
        }
        
        $product->update([
            'label' => $request->label,
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

        $product->categories()->sync($request->category);

        $product->save();

        return redirect()->route('product.show', $product->id)->with('success', 'Le produit' . $product->label . 'a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
    
        $product->delete();

        return redirect()->route('categories.index')->with('success', 'Le produit' . $product->label . 'a bien été supprimé');
    }
}
