<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $req) {
        if(Auth('sanctum')->check()) {
            return response([
                "message" => "you're already login"
            ]);
        }

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
        if(Auth('sanctum')->check()) {
            return response([
                "message" => "you're already login"
            ]);
        }
        $fields = $req->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
               'message' => 'Bad creds'
            ], 401);
        }

        $oldTokens = $user->tokens;
        foreach($oldTokens as $oldToken) {
            $oldToken->delete();
        }

        $token = $user->createToken('app_token', [$user->email == "admin@admin.com" ? 'admin' : 'user'])->plainTextToken;
        $response = [
          'user' => $user,
          'token' => $token
        ];

        return response($response, 201);
    }

    public function test() {
        if(auth('sanctum')->user()->tokenCan('admin')) {
            return "you're an admin!";
        } else {
            return "you're an user";
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return "you're logged out";
    }

}
