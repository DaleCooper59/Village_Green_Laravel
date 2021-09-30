<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function in_range($value, $min, $max): bool {
                           
        if ($value >= $min && $value <= $max) {
            return true;
        }
    
        return false;
    }

    public function index(){
        $products = Product::all();
        $categoriesParent = Category::where('parent_id', null)->get();
        $categoriesChild = Category::where('parent_id', !null)->get();        
        
        return view('categories.index', compact('categoriesParent', 'categoriesChild', 'products'));
    }   

    public function categoriesChild(Category $category){
       
        
        $categories = $category->where('parent_id',$category->id)->get();
        
        return view('categories.categoriesChild', compact('categories'));
    }

    
    public function show(Category $category){

        $products =  $category->products()->get();
        
        return view('categories.show', compact('category', 'products'));
    }
}
