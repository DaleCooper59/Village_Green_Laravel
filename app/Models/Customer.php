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
    public function userData()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the address for the customer.
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }


    //Relation polymorph with orders
    /**
     * Get all of the orders for the customers.
     */
    public function orders()
    {
        return $this->morphMany(Order::class, 'model');
    }
}
