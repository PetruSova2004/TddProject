<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Services\Date\DateService;
use Illuminate\View\View;


class IndexController extends Controller
{

    public function index(): View
    {
        return view('Pub.index');
    }

    public function test()
    {
        $user = User::query()->first();
        $coupons = $user->coupons;
        $s = new DateService();
        foreach ($coupons as $coupon) {
            $coupon->created_at = $s->getDateFormatDMY($coupon->created_at);
            $coupon->save();
        }
        dd($coupons);

    }

    public function test2()
    {

    }
}
