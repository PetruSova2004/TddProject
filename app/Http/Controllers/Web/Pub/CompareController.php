<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CompareController extends Controller
{
    public function index(): View
    {
        return view('Pub.shop-compare');
    }
}
