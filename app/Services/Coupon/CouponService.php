<?php

namespace App\Services\Coupon;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CouponService
{
    public function getCoupon(): JsonResponse
    {
        $user_id = Auth::guard('api')->user()->getAuthIdentifier();
        $user = User::query()->where('id', $user_id)->first();
        $code = $user->coupons->first()->code;

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
