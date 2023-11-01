<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 15.11.2020
 * Time: 10:22
 */

namespace App\Services\Response;


use Illuminate\Http\JsonResponse;

class ResponseService
{
    private static function responseParams($status, $errors = [], $data = []): array
    { // формируем параметры запроса
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
        ];
    }

    public static function sendJsonResponse($status, $code = 200, $errors = [], $data = [], $cookies = []): JsonResponse
    {
        $response = response()->json(
            self::responseParams($status, $errors, $data)
        );

        if ($cookies) {
            foreach ($cookies as $cookie) {
                $response->cookie($cookie['name'], $cookie['value'], $cookie['time']);
            }
        } else {
            return response()->json(
                self::responseParams($status, $errors, $data),
                $code
            );
        }
        return $response;
    }


    public static function success($data = []): JsonResponse
    { // этот метод мы будем использовать для отправки положительного ответа с определенном набором данных
        return self::sendJsonResponse(true, 200, [], $data);
    }

    public static function notFound(): JsonResponse
    {
        return self::sendJsonResponse(false, 404);
    }
}
