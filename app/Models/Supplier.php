<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'suppliers';

    protected $guarded = [];

    /**
     * Get the address for the supplier.
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    /**
     * Get all the products for the supplier.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'supplier_product', 'supplier_id', 'product_id');
    }
}
