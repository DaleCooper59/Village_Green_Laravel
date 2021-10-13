<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $village = Company::where('name', 'Village Green')->first();
      
        Employee::create([
            'user_id' => Auth::user()->id,
            'company_id' => $village->id,
            'department' => $request->department,
        ]);

        return redirect()->route('dashboard')->with('success', "Bravo, c'est l'heure de regarder un peu l'activité !");
    }
}
