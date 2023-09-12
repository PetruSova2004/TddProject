<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
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
        Cache::forget('cache');
        dd(Cache::get('cache'));
    }

    public function test2()
    {
        try {
            $id = 1;
            $existingProducts = Cache::get('cache');
            $newProduct = Product::query()->where('id', $id)->first();
            $match = false;

            if ($existingProducts) {
                foreach ($existingProducts as $item) {
                    if ($item->id === $newProduct->id) {
                        $match = true;
                        break;
                    }
                }
                if ($match === false) {
                    $existingProducts[] = $newProduct;
                }
            } else {
                $existingProducts[] = $newProduct;
            }

            Cache::put('cache', $existingProducts);
            dd(Cache::get('cache'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
