<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Http\Requests\Login;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        $validated = $request->validated();

        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->save();

        return response('success', 201);
    }

    public function login(Login $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return response('授權失敗', 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();

        return response([
            'token' => $tokenResult->accessToken,
        ]);
    }
}
