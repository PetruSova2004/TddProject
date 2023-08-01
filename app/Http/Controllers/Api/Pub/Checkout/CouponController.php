<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Api\Pub\Checkout\Services\CouponService;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{

    private $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }


    public function apply(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $coupon = Coupon::query()
            ->where('code', $request->input('code'))
            ->first();

        $existCouponCookie = Cookie::get('Coupon');

        if ($coupon && !$existCouponCookie) {
            $cookie = [
                'name' => 'Coupon',
                'value' => $coupon->code,
                'time' => 360,
            ];
            $dbUserCoupon = DB::table('coupon_user')
                ->where('user_id', $user->id)
                ->first();

            if ($dbUserCoupon) {
                return ResponseService::sendJsonResponse(false, 400, [
                    'Nope' => 'This user already have an active coupon',
                ]);
            } else {
                $coupon->users()->attach($user->id);
                return ResponseService::sendJsonResponse(true, 200, [], [
                    'success' => 'Coupon has been found',
                    'discount' => $coupon->discount_percent,
                ], $cookie);
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

        if ($coupon && $differenceInHours >= 6) {
            // Купон был активирован более 6 часов назад
            $user->coupons()->detach($coupon->id);

            return ResponseService::sendJsonResponse(true, 200, [], [
                'Deleted' => "Coupon " . $coupon->title . " has been removed by timeout",
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 200, [], [
                'Not yet' => "Coupon " . $coupon->title . " have only been activated for " . $differenceInHours . " hours",
            ]);
        }

    }


}
