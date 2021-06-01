<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
class AuthController extends Controller
{
    public function register(Request $req) {
        $fields = $req->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('app_token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $req) {
        $fields = $req->validate([
            'mail' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
               'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('app_token')->plainedTextToken;

        $response = [
          'user' => $user,
          'token' => $token
        ];

        return response($response, 201);
    }

    public function test() {
        return "you're logged in successfully";
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return "you're logged out";
    }

}
