<?php

namespace App\Services\Coupon;

use App\Models\Coupon;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CouponService
{
    public function getCoupon(Request $request)
    {
        $code = Cookie::get('Coupon');

        if ($code) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'Code' => $code,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Cannot find Cookie Coupon'
            ]);
        }

    }

}
