<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class LoginApiController extends Controller
{

    public function login(Request $request)
    {
        if (empty($request->email)) {
            return response()->json(['message' => 'email is required', 'statusCode' => 404]);
        }
        if (empty($request->password)) {
            return response()->json(['message' => 'password is required', 'statusCode' => 404]);
        }
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {

            if ($user->status == 1) {
                return response()->json([
                    'statusCode' => 200,
                    'status' => 'success',
                    'message' => 'Login Successfully',
                    'token' => $user->access_token,
                ], 200);
            } else {
                return response()->json(['statusCode' => 401, 'message' => 'You are not active User']);
            }

            //    return response()->json([
            //        'statusCode'=>200,
            //        'status' => 'success',
            //        'message'=>'Login Successfully',
            //        'token' =>$user->access_token,
            //    ], 200);
        }
        return response()->json(['statusCode' => 401, 'message' => 'Invalid credentials. Please enter vaild credentials']);
    }
}
