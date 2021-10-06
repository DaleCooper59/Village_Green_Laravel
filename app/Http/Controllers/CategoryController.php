<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function in_range($value, $min, $max): bool
    {

        if ($value >= $min && $value <= $max) {
            return true;
        }

        return false;
    }


    public function categoriesChild(Category $category)
    {

        $categories = $category->where('parent_id', $category->id)->get();
        $categoriesParent = Category::where('parent_id', null)->get();

        return view('categories.categoriesChild', compact('categories', 'categoriesParent'));
    }

    public function index()
    {
        $products = Product::all();
        $categoriesParent = Category::where('parent_id', null)->get();
        $categoriesChild = Category::where('parent_id', '!=', null)->get();
        
        return view('categories.index', compact('categoriesParent', 'categoriesChild', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $categories)
    {
        $categoriesParent = Category::where('parent_id', null)->get();;
        return view('categories.create', compact('categoriesParent'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        $path = $request->picture->storeAs(
            'pictures',
            'category'. time() . '.' . $request->picture->extension(),
            'public'
        );

        Category::create([
            'parent_id' => $request->parent_id === '' ? null : $request->parent_id,
            'name' => $request->name,
            'picture' => $path
        ]);

        return redirect()->route('categories.index')->with('success', 'Votre produit a bien été ajouté');
    }



    public function show(Category $category)
    {

        $products =  $category->products()->get();
        $categoriesParent = Category::where('parent_id', null)->get();

        return view('categories.show', compact('category', 'products', 'categoriesParent'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categoriesChild = Category::where('parent_id', !null)->get();
        $categoriesParent = Category::where('parent_id', null)->get();
        return view('categories.edit', compact('category', 'categoriesChild', 'categoriesParent') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $category = Category::find($category)->first();

        $category->update($request->input());

        $category->save();

        return redirect()->route('categories.index')->with('success', 'La catégorie a bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'La catégorie a bien été retirée');
    }
}
