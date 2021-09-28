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
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
    /**
     * Get the children Categories.
     */
    public function parent()
    {
        return $this->hasOne(Category::class);   
    }
    /**
     * Get the children Categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id', 'id');   
    }
    
}
