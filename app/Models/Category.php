<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'categories';

    protected $guarded = [];

    /**
     * Get the products for the category.
     */
    public function categories()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
    /**
     * Get the categories for the parent.
     */
    /*public function categoryChild()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }*/
}
