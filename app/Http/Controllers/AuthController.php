<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'country'=>'required',
            'password'=>'required',
        ]);

        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields ['email'],
            'phone_number' => $fields ['phone_number'],
            'country' => $fields ['country'],
            'password' => bcrypt($fields['password']),
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User has successfully registered',
            'data' => $user,
            'data' => $token,
        ]);
    }
}
