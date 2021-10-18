<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model //TASKS for employee
{
    use HasFactory, SoftDeletes;

    protected $table = 'todos';

    protected $guarded = [];

    /**
     * Get all the employees for this task.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_todo', 'todo_id', 'employee_id');
    }
}
