<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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

//Acceuil
Route::get('/index',  [ProductController::class, 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //basket
    Route::resource('basket', '\App\Http\Controllers\BasketController')->only(['index','store']);

    //orders
    Route::get('orders/create',  [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders/store',  [OrderController::class, 'store'])->name('orders.store');


    //catégories
    //Route::resource('categories', '\App\Http\Controllers\CategoryController');
    Route::get('categories',  [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/show/{category}',  [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/categoriesChild/{category}',  [CategoryController::class, 'categoriesChild'])->name('categories.categoriesChild');
 
    //customers
    Route::get('customers/show/{customer}',  [CustomerController::class, 'show'])->name('customers.show');

    //products
    Route::get('products/allProducts',  [ProductController::class, 'allProducts'])->name('products.allProducts');
    Route::get('products/show/{products}',  [ProductController::class, 'show'])->name('products.show');

    //products-supplier
    Route::group(['middleware' => ['supplier']], function () {
        Route::post('products/store',  [ProductController::class, 'store'])->name('products.store');
        Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('products/update/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::any('products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    ////ADMIN//// 
    Route::middleware('admin')->group(function () {
        //users
        Route::resource('users', '\App\Http\Controllers\UserController');

        //Role
        Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::patch('roles/update/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::any('roles/destroy/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

        //Permission
        Route::get('permissions/edit/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::patch('permissions/update/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::any('permissions/destroy/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

        //products-admin
        Route::get('products/create',  [ProductController::class, 'create'])->name('products.create');
        
        //categories
        Route::get('categories/create',  [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories/store',  [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::any('categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});
