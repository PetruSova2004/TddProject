<?php
/**
 * Created by PhpStorm.
 * User: note
 * Date: 15.11.2020
 * Time: 10:22
 */

namespace App\Services\Response;


use Illuminate\Support\Facades\Cookie;

class ResponseService
{
    private static function responseParams($status, $errors = [], $data = [], $cookie = null)
    { // формируем параметры запроса
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data,
            'cookie' => $cookie,
        ];
    }

    public static function sendJsonResponse($status, $code = 200, $errors = [], $data = [], $cookie = null)
    {
        if ($cookie) {
            return response()->json(
                self::responseParams($status, $errors, $data, $cookie['name']),
                $code
            )->cookie($cookie['name'], $cookie['value'], $cookie['time']);
        } else {
            return response()->json(
                self::responseParams($status, $errors, $data),
                $code
            );
        }
    }


    public static function success($data = [])
    { // этот метод мы будем использовать для отправки положительного ответа с определенном набором данных
        return self::sendJsonResponse(true, 200, [], $data);
    }

    public static function notFound($data = [])
    {
        return self::sendJsonResponse(false, 404, [], []);
    }
}
