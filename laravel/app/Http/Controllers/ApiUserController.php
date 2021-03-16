<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->only('email', 'password', 'name');
        $user = User::create($data);
        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = User::whereEmail($request->email)->first();
            $user->token = $user->createToken('User Token')->accessToken;
            return response()->json($user);
        } else {
            return response()->json([
                'error' => 'Sai tên đăng nhập hoặc mật khẩu',
            ], 401);
        }
    }

    public function getAuth(Request $request)
    {
        return response()->json($request->user('api'));
    }
}
