<?php

namespace App\Services\CustomToken;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomTokenService extends Controller
{
    public function generate(): JsonResponse
    {
        try {
            $token = bin2hex(random_bytes(16)); // Генерируем случайный токен
            $expiresAt = now()->addHours(48);

            DB::table('custom_tokens')->insert([
                'token' => $token,
                'expires_at' => $expiresAt,
            ]);

            return ResponseService::sendJsonResponse(true, 200, [], [
                'token' => $token,
            ]);
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function verify(Request $request): JsonResponse
    {
        $token = DB::table('custom_tokens')->where('token', $request->header('guestToken'))->first();

        if ($token && $token->expires_at > now()) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'Your token is valid'
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'Your token is invalid',
            ]);
        }
    }

}
