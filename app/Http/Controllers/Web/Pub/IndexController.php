<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class IndexController extends Controller
{
    public function index(): View
    {
        return view('Pub.index');
    }

    public function test()
    {
        dd(Session::all());
    }

    public function test2()
    {

    }
}
