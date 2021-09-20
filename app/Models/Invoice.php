<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'invoices';

    protected $guarded = [];

    /**
     * Get the order for the invoice.
     */
    public function order()
    {
        return $this->belongsTo(Invoice::class);
    }
}
