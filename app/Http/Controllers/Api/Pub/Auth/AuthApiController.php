<?php

namespace App\Http\Controllers\Api\Pub\Auth;

use App\Events\TokenCookieExpired;
use App\Http\Controllers\Api\Pub\Auth\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Auth\LoginRequest;
use App\Http\Requests\Pub\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AuthApiController extends Controller
{

    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $request->validated();

        $this->service->createUser($request);

        $user = User::query()->where('email', $request->input('email'))->first();

        if ($user) {
            $token = $user->createToken('PersonalAccessToken')->accessToken;
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'You have been registered successfully',
                'token' => $token,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 404, [
                'Oops, something goes wrong',
            ]);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        $user = User::query()->where('email', $request->input('email'))->first();

        if ($user && Auth::attempt($credentials)) {
            $token = $user->createToken('PersonalAccessToken')->accessToken;

            $cookie = [
                [
                    'name' => 'Token',
                    'value' => $token,
                    'time' => 240,
                ],
                [
                    'name' => 'esem',
                    'value' => $user->email,
                    'time' => 240,
                ]
            ];

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'You have successfully log in',
                'token' => $token,
                'user' => $user->makeHidden([
                    'id',
                    'google_id',
                    'email_verified_at',
                    'is_admin',
                    'created_at',
                    'updated_at',
                ]),
            ], $cookie);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'message' => 'Your credentials are invalid'
            ]);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->token()->revoke();
            Cache::forget('wishlist');

            $cookie = [
                [
                    'name' => 'Token',
                    'value' => null,
                    'time' => -1,
                ],
                [
                    'name' => 'esem',
                    'value' => null,
                    'time' => -1,
                ]
            ];

            event(new TokenCookieExpired($user));

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'You have been successfully log out',
                'user' => $user,
            ], $cookie);
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => $exception->getMessage()
            ]);
        }

    }


}
