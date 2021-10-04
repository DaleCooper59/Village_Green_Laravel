<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return view('users.index', compact('users'));
    }


    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user = user::find($user)->first();

        $user->update($request->all());

        $user->save();

        return redirect()->route('users.index')->with('success', 'L\'utilisateur' . $user->username . 'a bien été modifié')->with('success', 'Le produit a bien été modifié');
    }
}
