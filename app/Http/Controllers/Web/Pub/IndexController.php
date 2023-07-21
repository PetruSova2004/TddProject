<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
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
