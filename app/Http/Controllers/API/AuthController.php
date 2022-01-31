<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;


class AuthController extends Controller
{
    //
    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required|min:3|max:50',
            'email' => 'required|min:3|max:50',
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'city' => 'required|min:3|max:50',
            'state' => 'required|min:3|max:50',
            'country' => 'required|min:3|max:50',
            'phone' => 'required|min:3|max:50',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => '|required|same:password',
        ]);
        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'phone' => preg_replace('/^0/','+234',$request->phone),
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return response()->json(['message' => 'user has been registered'], 200); 
    }

    public function login(Request $request)
    {
        $request-> validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember' => 'boolean'
            
        ]);

        $login = request(['email', 'password']);

        if(!Auth::attempt($login))
        {
            return response(['message'=> 'Invalid login credentials'], 401);
        }

        $user = $request->user();
        $accessToken = $user->createToken('Personal Access Token');
        $token = $accessToken->token;
        $token ->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json(['data'=>[
            'user' => Auth::user(),
            'access_token' => $accessToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($accessToken->token->expires_at)->toDateTimeString()
        ]]);
    }

    public function logout() {

        if(Auth::check()) {
        Auth::user()->token()->revoke();
        return response()->json(["status" => "success", "error" => false, "message" => "Success! You are logged out."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! You are already logged out."], 403);
    }


    public function update(Request $request){
        try {
                $validator = Validator::make($request->all(),[
                'company_name' => 'required|min:2|max:45',
                'user_role' => 'required|min:2|max:45',
                'usertype' => 'required',
            ]);
                if($validator->fails()){
                    $error = $validator->errors()->all()[0];
                    return response()->json(['status'=>'false', 'message'=>$error, 'data'=>[]],422);
                }else{
                    $user = user::find($request->user()->id);
                            $user->company_name = $request->company_name;
                            $user->user_role = $request->user_role;
                            $user->usertype = $request->usertype;

                            $user->update();
                            return response()->json(['status'=>'true', 'message'=>"profile updated suuccessfully", 'data'=>$user]);
                }
    
        }catch (\Exception $e){
                    return response()->json(['status'=>'false', 'message'=>$e->getMessage(), 'data'=>[]], 500);
        }
    }




}
