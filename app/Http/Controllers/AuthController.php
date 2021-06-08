<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $req) {
        if(Auth('sanctum')->check()) {
            return response(config('responses.as_array.already_logged_in'),200);
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
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $req) {
        if(Auth('sanctum')->check()) {
            return response(config('responses.as_array.already_logged_in'),403);
        }
        $fields = $req->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response(config('responses.as_array.bad_creds'), 401);
        }

        $oldTokens = $user->tokens;
        foreach($oldTokens as $oldToken) {
            $oldToken->delete();
        }

        $token = $user->createToken('app_token', [$user->isAdmin() ? 'admin' : 'user'])->plainTextToken;
        $response = [
          'user' => new UserResource($user),
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

        return response(config('responses.as_array.logged_out'));
    }

}
