<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotRequest;
use App\User;
use Illuminate\Support\Str;
use DB;
use Mail;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request)
    {
        $email = $request -> input('email');
        if(User::where('email', $email)->doesntExist())
        {
            return response([
                'message' => 'user doesn\'t exists'
            ]);
        }
        $token = Str::random(10);
     try   {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
        ]);
           //send email
            Mail::send('Email.forgot',  [
            'token' => $token, 
            ], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Crystal Checks: Reset Password');
            }); 
         }catch (\Exception $exception){
        return response([
            'message' => $exception -> getMessage()
        ], 400);
    }
    }


    
}
