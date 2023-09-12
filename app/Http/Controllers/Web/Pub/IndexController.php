<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;


class IndexController extends Controller
{

    public function index(): View
    {
        return view('Pub.index');
    }

    public function test()
    {
        dd(Cache::get('cache'));
    }

    public function test2()
    {
        try {
            $product = Product::query()->get()->all();
            Cache::put('cache', $product, 20); // 20 секунд
            dd(Cache::get('cache'));
        } catch (\Exception $exception) {
            return dd($exception->getMessage());
        }
    }
}
