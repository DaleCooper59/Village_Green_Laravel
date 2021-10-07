<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'cities';

    protected $guarded = [];

    /**
     * Get all of the Address for the City.
     */
    public function address()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get all of the Countries for the city.
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
