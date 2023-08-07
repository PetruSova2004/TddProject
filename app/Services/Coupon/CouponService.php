<?php

namespace App\Services\Coupon;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CouponService
{
    public function getCoupon(): JsonResponse
    {
        $code = Cookie::get('Coupon');
        $user_id = Auth::guard('api')->user()->getAuthIdentifier();
        $user = User::query()->where('id', $user_id)->first();

        if ($user->coupons->count()) {
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
