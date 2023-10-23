<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Cookie;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->only('firstName', 'lastName', 'email')
            + ['password' => \Hash::make($request->input('password')),
                'is_admin' => 0
            ]
        );
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response([
                'error' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = \Auth::user();
        $jwt = $user->createToken('token', ['admin'])->plainTextToken;
        $cookie = cookie('jwt', $jwt, 60 * 24); // 1 day

        return response([
            'message' => 'Success Login'
        ])->withCookie($cookie);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request  $request)
    {
        $cookie = \Cookie::forget('jwt');

        return response([
            'message' => 'Success Logout'
        ])->withCookie($cookie);
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = $request->user();
        $user->update($request->only('firstName', 'lastName'));
        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        $user = $request->user();
        $user->update($request->only('email'));
        return response($user, Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->update(['password' => Hash::make($request->input('password'))]);
        return response($user, Response::HTTP_ACCEPTED);
    }
}
