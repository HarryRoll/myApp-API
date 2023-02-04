<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthCtrl extends Controller
{
    public function login (Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        

        $user = User::firstWhere("username", $request->username);

        if(!$user || !Hash::check( $request->password, $user->password)){
            return response()->json([
                'message' => 'Bad Credential' 
            ], Response::HTTP_NOT_FOUND);
        }

        $token = $user->createToken("sanctumToken")->plainTextToken;
    
        return response()->json([
            "message" => "login succesfully",
            "token" => $token
        ], Response::HTTP_OK);
    }

    public function getuser() {
        return response()->json([
            "user" => auth()->user()
        ], Response::HTTP_OK);
    }

 
    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
        "message" => "Successfully logged out."
        ], Response::HTTP_OK);
    }
}
