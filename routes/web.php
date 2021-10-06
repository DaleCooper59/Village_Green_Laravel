<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
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
    Route::get('registration', function () {
        return view('auth/register')->name('auth.registration');
    });
});

  //Acceuil
    Route::get('/index',  [ProductController::class, 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //Dashboard
    Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
  
    //Catégories
    //Route::resource('categories', '\App\Http\Controllers\CategoryController');
    Route::get('categories',  [CategoryController::class, 'index'])->name('categories.index'); 
    Route::get('categories/show/{category}',  [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/categoriesChild/{category}',  [CategoryController::class, 'categoriesChild'])->name('categories.categoriesChild');
  
    //Products
    Route::get('products/show/{products}',  [ProductController::class, 'show'])->name('products.show');
   
    //customers
    Route::get('customers/show/{customer}',  [CustomerController::class, 'show'])->name('customers.show');
   

    ////ADMIN//// 
    Route::middleware('admin')->group(function () {
        //users
        Route::resource('users', '\App\Http\Controllers\UserController');

        //products
        Route::get('products/create',  [ProductController::class, 'create'])->name('products.create');
        Route::post('products/store',  [ProductController::class, 'store'])->name('products.store'); 
        Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('products/update/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        //categories
        Route::get('categories/create',  [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories/store',  [CategoryController::class, 'store'])->name('categories.store'); 
        Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
   });
});
