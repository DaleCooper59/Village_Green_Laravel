<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('test',  [Controller::class, 'test']);

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth/login');
    });
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //Acceuil
    Route::get('/index',  [ProductController::class, 'index'])->name('index');
    
    //Dashboard
    Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
  
    //Catégories
    Route::resource('categories', '\App\Http\Controllers\CategoryController');
    Route::delete('categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('categories/categoriesChild/{category}',  [CategoryController::class, 'categoriesChild'])->name('categories.categoriesChild');
  
    
    ////ADMIN//// 
    //Route::middleware('admin')->group(function () {
        Route::get('products/create',  [ProductController::class, 'create'])->name('products.create');
        Route::post('products/store',  [ProductController::class, 'store'])->name('products.store');
        Route::get('products/show/{products}',  [ProductController::class, 'show'])->name('products.show');
        Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('products/update/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
   // });
});
