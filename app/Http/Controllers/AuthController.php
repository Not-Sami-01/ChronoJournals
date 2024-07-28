<?php

namespace App\Http\Controllers;

use App\Models\AppUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function signup(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        $checkuser = AppUsers::where('username', '=', $request->username)->first();
        if($checkuser){
            return response()->json(['success'=> false, 'message' => 'User already exists'], 401);
        }
        $password = md5($request->password);
        $user = new AppUsers();
        $user->username = $request->username;
        $user->password = $password;
        $user->save();
        return response()->json(["success" => true, "message" => "Signed up successfully now you can login to our website."], 200);
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = AppUsers::where('username', '=', $request->username)->first();
        if($user && md5($request->password) == $user->password){
            return response()->json(['success'=> true, 'authToken' => md5($request->username)], 200);
        }
        return response()->json(['success'=> false, 'message' => 'Invalid Credentials'], 401);
    }
}
