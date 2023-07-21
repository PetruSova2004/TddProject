<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('Pub.products');
    }

    public function showProduct(Request $request)
    {
        return view('Pub.single-product');
    }

}
