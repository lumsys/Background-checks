<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Company;

class CompanyController extends Controller
{
    //

    //
    public function store(Request $request){

        $client = new company();
        $client ->name=$request->name;
        $client ->address=$request->address;
        $client -> save();
        return response()->json(['success' => true, $client]);
    }

public function getCompany(){
        $getCli = company::all();
        return response()->json(['success' => true, $getCli]);
    }
    
public function CreateUsers(Request $request)    
        {
            $this->validate($request, [
                'username' => 'required|min:3|max:50',
                'email' => 'required|min:3|max:50',
                'user_role' => 'required',
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|min:3|max:50',
                'phone' => 'required|min:3|max:50',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => '|required|same:password',
            ]);
            $user = new User([
                'user_role' => $request->user_role,
                'username' => $request->username,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => preg_replace('/^0/','+234',$request->phone),
                'password' => Hash::make($request->password)
            ]);
            $user->save();
            return response()->json(['message' => 'user has been registered'], 200); 
        }

        


        public function UpdateCompany(Request $request, $id)
{
    //
                 $ClientsUser=Company::find($id);
                 $ClientsUser->update($request->all());
                 return response()->json(['success' => true, $ClientsUser]);
                

}

public function destroy($id)
{
    
    // Company::find($id)->delete();

        $Comp=Company::find($id);
        $Comp->delete();
        return response()->json(['success' => true]);

}

}
