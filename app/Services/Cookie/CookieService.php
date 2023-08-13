<?php

namespace App\Services\Cookie;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Cookie;

class CookieService extends Controller
{

    public function getCookie($cookieName)
    {
        $value = Cookie::get($cookieName);
        if ($value) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                "cookie" => $value,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 200, [
                'error' => 'Oops, your cookie is not available'
            ]);
        }
    }

    public function removeCookie($cookieName)
    {
        $value = Cookie::get($cookieName);
        $dataForDelete = [
            'name' => $cookieName,
            'value' => null,
            'time' => -1,
        ];
        if ($value) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'cookie' => "Cookie " . $cookieName . " has been successfully deleted",
            ], $dataForDelete);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'Oops, your cookie is not available'
            ]);
        }
    }

}
