<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $roles = Role::all();
        $permissions = Permission::all();
        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user = user::find($user)->first();

        $request->validate([
            'username' => 'unique:users',
        ]);

        $user->update([
            'username' => $request->username,
        ]);
        
        $user->syncRoles($request->role);
        $user->syncPermissions($request->permission);

       
        $user->save();

        return redirect()->route('users.index')->with('success', 'L\'utilisateur' . $user->username . 'a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Le compte de' . $user->username . 'a bien été supprimé');
    }
}
