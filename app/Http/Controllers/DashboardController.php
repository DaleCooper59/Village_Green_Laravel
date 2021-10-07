<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function dashboard(){
        $roles = Role::all();
            $permissions = Permission::all();
            return view('dashboard', compact('roles', 'permissions'));
    }
}
