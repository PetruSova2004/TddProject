<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\User;
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
        $carts = $user->cart;
        $products = [];

        foreach ($carts as $cart) {
            $products[] = Product::query()->where('id', $cart->product_id)->first();
        }
        dd($products);
    }

    public function test2()
    {

    }
}
