<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=> 'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|confirmed'
        ]);
        $user= User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response =[
            'message'=>"Request Successful",
            'response_code'=>201,
            'data'=>[
                'user'=>$user,
                'token'=>$token
            ]
            ];
        return response($response,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string'
        ]);
        $user= User::where('email',$fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            $response =[
                'message'=>"Bad Credentials",
                'response_code'=>401,
                'data'=>[]
                ];
            return response($response,401);
        }
        $token=$user->createToken('myapptoken')->plainTextToken;
        $response =[
            'message'=>"Request Successful",
            'response_code'=>201,
            'data'=>[
                'user'=>$user,
                'token'=>$token
            ]
            ];
        return response($response,201);
    }


    public function logout(){
        auth()->user()->tokens()->delete();
        $response =[
            'message'=>"Logged out",
            'response_code'=>201,
            'data'=>[]
            ];
        return response($response,201);
    }
}
