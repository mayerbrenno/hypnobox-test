<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:255'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "The provided credentials are incorrect"], 401);
        }

        $token = $user->createToken('Auth-Token')->plainTextToken;

        return response()->json([
            "message" => "Login Successful",
            'token_type' => 'Bearer',
            'token' => $token
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($user) {
            $token = $user->createToken('Auth-Token')->plainTextToken;

            return response()->json([
                "message" => "Login Successful",
                'token_type' => 'Bearer',
                'token' => $token
            ], 201);
        } else {
            return response()->json([
                "message" => "Registration Failed"
            ]);
        }
    }

    public function profile(Request $request)
    {
        if ($request->user()) {
            return response()->json([
                "message" => "Profile Information",
                'data' => $request->user()
            ]);
        } else {
            return response()->json([
                "message" => "Could not fetch profile information"
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                "message" => "Logout Successful"
            ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }
}
