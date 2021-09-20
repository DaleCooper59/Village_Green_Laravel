<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'employees';

    protected $guarded = [];

    /**
     * Get the userData for the employee.
     */
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the company for the employee.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
