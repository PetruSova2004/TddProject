<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('Pub.shop-checkout');
    }
}
