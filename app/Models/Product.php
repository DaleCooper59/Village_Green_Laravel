<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'products';

    protected $guarded = [];

    /**
     * Get all the suppliers for the product.
     */
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_product', 'product_id', 'supplier_id');
    }
    /**
     * Get all the orders for the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }
    /**
     * Get all the categories for the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    //Relation polymorph manytomany with tags
    /**
     * Get all of the tags for the products.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
