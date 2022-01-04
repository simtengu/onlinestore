<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    

    public function register(Request $request){

        $request->validate([
         'email'=>'required|unique:users,email',
        ]);
        
    $new_user = new User();
    $new_user->name = $request->name;
    $new_user->email = $request->email;
    $new_user->password = Hash::make($request->password);
    
    if ($new_user->save()) {
        $token =  $new_user->createToken('authToken', ['server:administrate'])->plainTextToken;
        return response()->json(['message'=>'user created','user'=>$new_user,'access_token'=> $token],201);
       
    }

    }

public function login(Request $request){
    $user = User::where('email',$request->email)->first();
    if ($user) {
        if (Hash::check($request->password, $user->password)) {
           
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status'=>'success','access_token'=>$token,'user'=>$user],200);

        }else{
            return response()->json(['message'=>'wrong username or password'],203);
        }
    }else{
        return response()->json(['message'=>'wrong username or password'],203);
    }

}

}
