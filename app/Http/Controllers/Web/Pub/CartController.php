<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('Pub.shop-cart');
    }
}
