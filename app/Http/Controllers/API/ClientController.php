<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use App\User;

class ClientController extends Controller
{
    //
    public function store(){

            $client = new client();
            $client ->name=$request->string('name');
            $client ->name=$request->string('address');
            $client -> save();
            return response()->json(['success' => true,]);
        }

    public function getClient(){
            $getCli = client::all();
            return response()->json(['success' => true, $getCli]);
        }
        
public function CreateUsers(Request $request)    
            {
                $this->validate($request, [
                    'username' => 'required|min:3|max:50',
                    'email' => 'required|min:3|max:50',
                    'user_role' => 'nullable',
                    'first_name' => 'required|min:3|max:50',
                    'last_name' => 'required|min:3|max:50',
                    'phone' => 'required|min:3|max:50',
                    'password' => 'required|confirmed|min:6',
                    'password_confirmation' => '|required|same:password',
                ]);
                $user = new User([
                    'username' => $request->username,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'user_role' => $request->usertype,
                    'phone' => preg_replace('/^0/','+234',$request->phone),
                    'password' => Hash::make($request->password),
                ]);
                $user->save();
                return response()->json(['message' => 'user has been registered'], 200); 
            }

            public function getUser(){
                $getUser = User::all();
                return response()->json(['success' => true, $getUser]);
            }

        
}
