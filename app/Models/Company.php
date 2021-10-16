<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'companies';

    protected $guarded = [];

    /**
     * Get the employees for the company.
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    /**
     * Get the address for the customer.
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }


    
}
