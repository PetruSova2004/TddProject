<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Mail\Checkout\ConfirmationMail;
use App\Mail\WelcomeEmail;
use App\Models\Order;
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

    public GatewayInterface $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
    public function index(): View
    {
        return view('Pub.index');
    }

    public function test()
    {
        $order = Order::query()->first();
        $products = json_decode($order->ordered_products);
        $x = [];
        $totalPrice = 0;

        foreach ($products as $product) {
            $x[] = [
                'title' => $product->title,
                'price' => $product->price_x1,
                'quantity' => $product->quantity,
            ];
        }
        foreach ($x as $item) {
            $totalPrice += floor($item['price']) * $item['quantity'];
        }

        dump($x);
        dd($totalPrice);

    }

    public function test2()
    {

    }
}
