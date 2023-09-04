<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Mail\Checkout\ConfirmationMail;
use App\Mail\WelcomeEmail;
use App\Models\Order;
use App\Models\User;
use App\Services\Country\CountryService;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;
use function Symfony\Component\Translation\t;


class IndexController extends Controller
{

    public function index(): View
    {
        return view('Pub.index');
    }

    public function test()
    {
        $user = User::query()->first();
        $discount = 0;
        $coupons = $user->coupons;

        foreach ($coupons as $coupon) {
            $discount += $coupon->discount_percent;
        }
    }

    public function test2()
    {

    }
}
