<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use SoftDeletes, HasFactory, HasRoles;

    protected $table = 'employees';

    public $guard_name = 'web';

    protected $guarded = [];

    /**
     * Get the userData for the employee.
     */
    public function user()
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

    /**
     * Get all the tasks for this employee.
     */
    public function todos()
    {
        return $this->belongsToMany(Todo::class, 'employee_todo', 'employee_id', 'todo_id');
    }

    //Relation polymorph with orders
    /**
     * Get all of the orders for the company.
     */
    public function orders()
    {
        return $this->morphOne(Order::class, 'model');
    }
}
