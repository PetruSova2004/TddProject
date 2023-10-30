<?php

namespace App\Services\Coupon;

use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CouponTrait
{
    public function getFormattedCoupons($coupons): Collection
    {
        return $coupons->map(function ($coupon) {
            $expired = false;

            $query = DB::table('coupon_user')
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->where('coupon_id', $coupon->id);

            $time = $query->value('created_at');

            $x = $query->first();
            $targetCarbonDate = Carbon::parse($x->expires_at);
            $currentDate = Carbon::now();
            if ($currentDate->gt($targetCarbonDate)) {
                // Текущая дата больше заданной даты
                $expired = true;
            }

            return [
                'code' => $coupon->code, 'discount_percent' => $coupon->discount_percent,
                'created_at' => Carbon::parse($time)->toDateTimeString(),
                'expired' => $expired,
            ];
        });
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

}
