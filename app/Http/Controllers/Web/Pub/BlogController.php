<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function blog(): View
    {
        return view('Pub.blog');
    }

    public function blogDetails(): View
    {
        return view('Pub.blog-details');
    }

}
