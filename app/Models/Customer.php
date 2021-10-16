<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'customers';

    protected $guarded = [];

    /**
     * Get the userData for the customer.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the address for the customer.
     */
    public function address()
    {
        return $this->belongsToMany(Address::class,'address_customer', 'customer_id', 'address_id');
    }


    //Relation polymorph with orders
    /**
     * Get all of the orders for the customers.
     */
    public function order()
    {
        //return $this->morphMany(Order::class, 'model');
        return $this->morphOne(Order::class, 'model');
    }

    
}
