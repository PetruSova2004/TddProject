<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Api\Pub\Checkout\Services\CouponService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Checkout\CouponRequest;
use App\Models\Coupon;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{

    private CouponService $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    public function apply(CouponRequest $request): JsonResponse
    {
        $coupon = Coupon::query()
            ->where('code', $request->input('code'))
            ->first();

        if ($coupon) {
            if ($coupon instanceof Coupon) {
                return $this->service->applyCoupon($coupon);
            } else {
                return ResponseService::sendJsonResponse(false, 400, [
                    'Error' => 'Coupon was not found'
                ]);
            }
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Something is wrong with this coupon',
            ]);
        }
    }

    public function delete(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $coupon = Coupon::query()
            ->where('code', $request->input('code'))
            ->first();

        $differenceInHours = $this->service->getTimeDifference($user, $coupon);

        if ($coupon) {
            $user->coupons()->detach($coupon->id);
            $cookie = [
                'name' => 'Coupon',
                'value' => $coupon->code,
                'time' => -1,
            ];

            return ResponseService::sendJsonResponse(true, 200, [], [
                'Deleted' => "Coupon " . $coupon->title . " has been removed by timeout",
            ], $cookie);
        } else {
            return ResponseService::sendJsonResponse(false, 200, [], [
                'Not yet' => "Coupon " . $coupon->title . " have only been activated for " . $differenceInHours . " hours",
            ]);
        }
    }


}
