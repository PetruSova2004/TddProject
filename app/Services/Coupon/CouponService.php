<?php

namespace App\Services\Coupon;

use App\Models\User;
use App\Services\Response\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponService
{
    use CouponTrait;
    public function getCoupon(): JsonResponse
    {
        $user_id = Auth::guard('api')->user()->getAuthIdentifier();
        $user = User::query()->where('id', $user_id)->first();
        $coupons = $user->coupons;

        if ($coupons->count()) {
            $formattedData = $this->getFormattedCoupons($coupons);
            return ResponseService::sendJsonResponse(true, 200, [], [
                'coupons' => $formattedData,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Cannot find Cookie Coupon'
            ]);
        }
    }



}
