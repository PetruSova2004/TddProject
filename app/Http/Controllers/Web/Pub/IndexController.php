<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\View\View;


class IndexController extends Controller
{

    public function index(): View
    {
        return view('Pub.index');
    }

    public function test()
    {

    }

    public function test2()
    {

    }
}
