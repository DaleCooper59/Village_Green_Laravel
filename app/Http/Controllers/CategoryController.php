<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        
        return view('categories.index', compact('categories'));
    }

    public function categoriesChild(Request $request){
       
        $categories = Category::where('parent_id',2)->get();

        return view('categories.categoriesChild', compact('categories'));
    }
}
