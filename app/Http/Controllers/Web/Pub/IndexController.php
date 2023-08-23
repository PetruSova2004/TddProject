<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Services\Country\CountryService;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use function Symfony\Component\Translation\t;


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
