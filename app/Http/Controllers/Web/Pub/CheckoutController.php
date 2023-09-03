<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('Pub.shop-checkout');
    }

    public function confirmOrder(): View
    {
        return view('Pub.mail.after-confirm-email');
    }

}
