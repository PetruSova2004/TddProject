<?php

namespace App\Http\Controllers\Web\Admin\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('Admin.Index.index');
    }
}
