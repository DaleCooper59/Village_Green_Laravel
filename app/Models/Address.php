<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'address';

    protected $guarded = [];

    /**
     * Get the companies for the address.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    /**
     * Get the city for the address.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    /**
     * Get the customers for the address.
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    /**
     * Get the suppliers for the address.
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
    /**
     * Get the orders for the category.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'address_id', 'order_id');
    }
}
