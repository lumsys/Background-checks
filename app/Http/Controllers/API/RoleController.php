<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function show(){
        $roles = Role::all();

        return response()->json(['success' => true, $roles]);
    }

    public function storee(){

        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name'=> Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-')
        ]);

        return response()->json(['success' => true]);

    }

    public function delete(Role $role){

        $role=User::find($id);
        $role->delete();
        return response()->json(['success' => true]);
    }

    public function attach(User $user)
    {
            $user->roles()->attach(request('role'));
            return response()->json(['success' => true]);

    }

    public function detach(User $user)
    {
            $user->roles()->detach(request('role'));
            return response()->json(['success' => true]);

    }
}
