<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Http\Request;

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
}
