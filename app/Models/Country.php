<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'countries';

    protected $guarded = [];

    /**
     * Get all of the cities for the Country.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
