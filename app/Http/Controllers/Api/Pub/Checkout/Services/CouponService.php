<?php

namespace App\Http\Controllers\Api\Pub\Checkout\Services;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CouponService extends Controller
{
    public function commonQuery(Request $request): Builder
    {
        $coupon = Coupon::query()
            ->where('id', $request->input('coupon_id'))
            ->first();
        $user = Auth::guard('api')->user();
        $query = DB::table('coupon_user')
            ->where('user_id', $user->id)
            ->where('coupon_id', $coupon->id);

        return $query;
    }

    public function getTimeDifference($query)
    {
        $createdAtTime = $query->value('created_at');
        $currentTime = Carbon::now();
        $activatedCouponTime = Carbon::parse($createdAtTime)->addHours(7);

        return $currentTime->diffInHours($activatedCouponTime);

    }

}
