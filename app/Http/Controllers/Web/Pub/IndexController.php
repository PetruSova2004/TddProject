<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

class IndexController extends Controller
{
    public function index()
    {
        return view('Pub.index');
    }

    public function test()
    {
        dd(Cookie::get('User'));
    }

    public function test2()
    {

    }
}
