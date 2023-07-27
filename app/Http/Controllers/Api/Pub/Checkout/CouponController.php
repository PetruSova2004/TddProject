<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function apply(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();
        $coupon = Coupon::query()
            ->where('code', $request->input('code'))
            ->first();
        if ($coupon) {
            $cookie = [
                'name' => 'Coupon',
                'value' => $coupon->code,
                'time' => null,
            ];

            if ($user->coupons->contains($coupon->id)) {
                return ResponseService::sendJsonResponse(false, 400, [
                    'Nope' => 'This user already have an active coupon',
                ]);
            } else {
                $coupon->users()->attach($user->id);
            }
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'Coupon has been found',
            ], $cookie);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Something is wrong with this coupon',
            ]);
        }
    }
}
