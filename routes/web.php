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
  
    //Catégories
    Route::resource('categories', '\App\Http\Controllers\CategoryController');
    Route::get('categories/categoriesChild/{category}',  [CategoryController::class, 'categoriesChild'])->name('categories.categoriesChild');
  
    
    ////ADMIN////
    //Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
   // });
});
