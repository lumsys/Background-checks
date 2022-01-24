<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                    'usertype' => 'nullable',
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
                    'usertype' => $request->usertype,
                    'phone' => preg_replace('/^0/','+234',$request->phone),
                    'password' => Hash::make($request->password),
                ]);
                $user->save();
                return response()->json(['message' => 'user has been registered'], 200); 
            }

        
}
