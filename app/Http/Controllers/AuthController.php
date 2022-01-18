<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Issue Token & return
     */
    public function login() {
        $info = request()->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if( auth()->attempt( $info ) ) {
            $user = auth()->user();
            $token = $user->createToken( $user->username );

            return response()->json([
                "token" => $token->plainTextToken,
            ]);
        }

        throw ValidationException::withMessages([
            "username" => "Wrong Credentials"
        ]);
    }

    /**
     * Check if token is valid
     */
    public function check() {
        dd( auth()->check() );
    }

    /**
     * Remove All Tokens
     */
    public function logout() {
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            "msg" => "success"
        ]);
    }
}
