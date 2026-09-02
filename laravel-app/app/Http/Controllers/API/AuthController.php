<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SigninRequest;
use App\Http\Requests\User\SignupRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {  
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully', 
            'user' => new UserResource($user)
            ], 201);
    }
    public function signin(SigninRequest $request)
    {

        $user= User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

         $token = $user->createToken('auth_token')->plainTextToken;

         return response([
            'message' => 'User signed in.',
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
    }

    public function signout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response([
            'message'=> 'User signed out',
        ], 200);
    }

    public function verify(request $request)
    {
        $user = $request->user();
        if($user){
            return response([
                'message' => 'User is authenticated',
                'user' => new UserResource($user),
            ], 200);
        }else{
            return response([
                'message' => 'User is not authenticated',
            ], 401);
        }
    }
}