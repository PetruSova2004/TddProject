<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('Pub.products');
    }

    public function showProduct(Request $request): View
    {
        if ($request->input('id')) {
            return view('Pub.single-product');
        } else {
            return view('Pub.page-not-found');
        }
    }

}
