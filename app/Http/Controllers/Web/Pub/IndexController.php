<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Models\Coupon;


class IndexController extends Controller
{
    public function index()
    {
        return view('Pub.index');
    }

    public function test()
    {
        $coupon = Coupon::query()->first();
        dd($coupon->users);
    }

    public function test2()
    {

    }
}
