<?php

namespace App\Http\Controllers\Api\Pub\Auth;

use App\Events\TokenCookieExpired;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Auth\LoginRequest;
use App\Http\Requests\Pub\Auth\RegisterRequest;
use App\Models\Cart;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthApiController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $request->validated();

        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = $user->createToken('PersonalAccessToken')->accessToken;
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'You have been registered successfully',
                'token' => $token,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Oops, something goes wrong',
            ]);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        $user = User::query()->where('email', $request->email)->first();

        if ($user && Auth::attempt($credentials)) {
            $token = $user->createToken('PersonalAccessToken')->accessToken;

            $cookie = [
                'name' => 'Token',
                'value' => $token,
                'time' => 60,
            ];

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'You have successfully log in',
                'token' => $token,
            ], $cookie);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'message' => 'Your credentials are invalid'
            ]);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->token()->revoke();

        event(new TokenCookieExpired($user));

        return ResponseService::sendJsonResponse(true, 200, [], [
            'success' => 'You have been successfully log out',
            'cartProducts' => "Cart Products has been deleted",
            'user' => $user,
        ]);
    }


}
