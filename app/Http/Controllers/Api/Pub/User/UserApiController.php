<?php

namespace App\Http\Controllers\Api\Pub\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\User\UpdateRequest;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function getUserByToken(): JsonResponse
    {
        $user = User::query()
            ->where('id', Auth::guard('api')
                ->user()->getAuthIdentifier())
            ->first();

        if ($user) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'message' => 'User was successfully found',
                'email' => $user->email,
                'name' => $user->name,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Oops, something goes wrong',
            ]);
        }
    }

    public function updateProfile(UpdateRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
            $user->fill($validatedData); // Бросит исключение, если данные невалидны
            $user->save();

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'Data has been successfully changed',
            ]);
        } catch (\Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'Error: ' . $exception->getMessage(),
            ]);
        }
    }

}
