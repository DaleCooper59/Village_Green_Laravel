<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Product $products, Category $categories)
    {

        $categoriesParent =  Category::whereNull('parent_id')->with('children')->get();
        $customers = Customer::all();
        return view('index', compact('products', 'categories', 'categoriesParent', 'customers'));
    }

    public function allProducts(){
        $categoriesParent =  Category::whereNull('parent_id')->with('children')->get();
        $customers = Customer::all();
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories', 'categoriesParent', 'customers'));
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
        $categoriesParent = Category::where('parent_id', null)->get();

        return view('products.create', compact('categories', 'categoriesChild', 'categoriesParent'));
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
        $categoriesParent = Category::where('parent_id', null)->get();
        return view('products.show', compact('products', 'categoriesParent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $categoriesChild = $categories->where('parent_id', !null);
        $categoriesParent = Category::where('parent_id', null)->get();
        return view('products.edit', compact('product', 'categories', 'categoriesChild', 'categoriesParent'));
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

        $product = Product::find($product)->first();

       /* if ($_FILES['picture']) {
            $path = public_path() . 'img/';

            //code for remove old file
            if ($product->file != ''  && $product->file != null) {
                $file_old = $path . $product->file;
                unlink($file_old);
                
            }

            //upload new file
            $file = $_FILES['picture'];
            $filename = $_FILES['picture']['name'];
            $file->move($path, $filename);

            //for update in table
            $product->update(['picture' => $filename]);

        }*/

        /*
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }*/
        $product->update($request->input());

        $product->categories()->sync($request->category);

        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', 'Le produit' . $product->label . 'a bien été modifié')->with('success', 'Le produit a bien été modifié');
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
