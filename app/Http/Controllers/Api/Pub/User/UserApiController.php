<?php

namespace App\Http\Controllers\Api\Pub\User;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function getUserByToken()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'message' => 'User was successfully found',
                'email' => $user->email,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Oops, something goes wrong',
            ]);
        }
    }
}
