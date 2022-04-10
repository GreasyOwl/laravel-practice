<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use App\Http\Requests\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
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

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response([
            'message' => '成功登出',
        ]);
    }

    public function user(Request $request)
    {
        return response($request->user());
    }

    public function getNotifications()
    {
        $notifications = auth()->user()->notifications ?? [];

        $payload = [];
        foreach ($notifications as $notification) {
            $payload = [
                'id' => $notification->id,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
            ];
        }

        return response($payload);
    }

    public function readNotification(Request $request)
    {
        $id = $request->id;

        DatabaseNotification::find($id)->markAsRead();

        return response([
            'result' => true,
        ]);
    }
}
