<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function index()
    {
        return view('Pub.index');
    }

    public function test()
    {
        
    }

    public function test2()
    {

    }
}
