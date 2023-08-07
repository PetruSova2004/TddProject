<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('Pub.products');
    }

    public function showProduct(): View
    {
        return view('Pub.single-product');
    }

}
