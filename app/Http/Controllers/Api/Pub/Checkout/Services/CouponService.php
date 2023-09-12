<?php

namespace App\Http\Controllers\Api\Pub\Checkout\Services;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Services\Response\ResponseService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponService extends Controller
{

    public function applyCoupon(Coupon $coupon): JsonResponse
    {
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
        $coupons = $user->coupons;

        $totalDiscount = $this->checkDiscount($coupons, $coupon);

        if ($totalDiscount > 40) {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Sorry but u cant add another coupon',
            ]);
        }

        $dbUserCoupon = DB::table('coupon_user')
            ->where('user_id', $user->getAuthIdentifier())
            ->where('coupon_id', $coupon->id)
            ->first();

        if ($dbUserCoupon) {
            return ResponseService::sendJsonResponse(false, 400, [
                'Nope' => 'This user already have this coupon',
            ]);
        }
        $cookie = [
            'name' => 'Coupon',
            'value' => $coupon->code,
            'time' => 360,
        ];
        DB::table('coupon_user')
            ->insert([
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
                'expires_at' => now()->addHours(48),
            ]);
        return ResponseService::sendJsonResponse(true, 200, [], [
            'success' => 'Coupon has been found',
            'discount' => $coupon->discount_percent,
        ], $cookie);
    }

    public function commonQuery(Request $request): Builder
    {
        $coupon = Coupon::query()
            ->where('id', $request->input('coupon_id'))
            ->first();
        $user = Auth::guard('api')->user();

        return DB::table('coupon_user')
            ->where('user_id', $user->getAuthIdentifier())
            ->where('coupon_id', $coupon->id);
    }

    public function getTimeDifference(Authenticatable $user, $coupon): int
    {
        $createdAtTime = DB::table('coupon_user')
            ->where('user_id', $user->getAuthIdentifier())
            ->where('coupon_id', $coupon->id)
            ->value('created_at');
        $currentTime = Carbon::now();
        $activatedCouponTime = Carbon::parse($createdAtTime);

        return $currentTime->diffInHours($activatedCouponTime);
    }

    public function getUserDiscount(): int
    {
        $user = User::query()
            ->where('id', Auth::user()->getAuthIdentifier())
            ->first();
        $discount = 0;

        $x = [];
        $y = DB::table('coupon_user')->where('user_id', $user->id)->get();

        foreach ($y as $item) {
            $targetCarbonDate = Carbon::parse($item->expires_at);
            $currentDate = Carbon::now();
            if (!$currentDate->gt($targetCarbonDate)) {
                // Текущая дата не больше заданной даты
                $x[] = $item->coupon_id;
            }
        }
        $coupons = Coupon::query()->whereIn('id', $x)->get();

        if ($coupons) {
            foreach ($coupons as $coupon) {
                $discount += $coupon->discount_percent;
            }
        }

        return $discount;
    }

    public function checkDiscount($coupons, $coupon = null): int
    {
        $discount = 0;

        foreach ($coupons as $item) {
            $discount += $item->discount_percent;
        }
        return $discount + $coupon->discount_percent;
    }
}
