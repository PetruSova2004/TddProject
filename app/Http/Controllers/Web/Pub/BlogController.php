<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog()
    {
        return view('Pub.blog');
    }

    public function blogDetails()
    {
        return view('Pub.blog-details');
    }

}
