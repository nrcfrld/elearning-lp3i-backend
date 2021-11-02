<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($attr)) {
            return response()->json([
                'message' => 'Credentials not match'
            ], 401);
        }

        return response()->json([
            'access_token' => auth()->user()->createToken('API TOKEN '. $request->email)->plainTextToken,
            'user' => auth()->user()->load('roles.permissions')
        ], 200);
    }

    public function verify(){
        $user = auth()->user();

        $user->tokens()->delete();

        return response()->json([
            'access_token' => $user->createToken('API TOKEN '. $user->email)->plainTextToken,
            'user' => $user->load('roles.permissions')
        ], 200);
    }
}
