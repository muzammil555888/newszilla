<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $loginDetails = $request->only('email', 'password');
        
        if (Auth::attempt($loginDetails)) {
            return response()->json(['message' => 'Login Successful', 'status' => true]);
        } else {
            return response()->json(['message' => 'Login Failed', 'status' => false]);
        }
    }

    public function register ()
    {
        # code...
    }
}
