<?php

namespace App\Http\Controllers\Api\Pub\Wishlist\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Wishlist\WishlistRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class WishlistService extends Controller
{
    public function add($product): array
    {
        $existingProducts = Cache::get('wishlist');
        $match = false;

        if ($existingProducts) {
            foreach ($existingProducts as $item) {
                if ($item['id'] === $product['id']) {
                    $match = true;
                    break;
                }
            }
            if ($match === false) {
                $existingProducts[] = $product;
            }
        } else {
            $existingProducts[] = $product;
        }
        return $existingProducts;
    }

    public function getProduct(WishlistRequest $request): array
    {
        $query = Product::query()
            ->where('id', $request->input('productId'))
            ->first();
        if ($query->count > 0) {
            $query['in_stock'] = 'Yes';
        } else {
            $query['in_stock'] = 'No';
        }

        return $query->makeHidden([
            'created_at',
            'updated_at',
            'category_id',
            'count',
            'description',
        ])->toArray();
    }

    public function checkCount($wishlist): array
    {
        foreach ($wishlist as $key => $value) {
            $product = Product::query()->where('id', $value['id'])->first();
            if ($product->count > 0) {
                $wishlist[$key]['in_stock'] = 'Yes';
            } else {
                $wishlist[$key]['in_stock'] = 'No';
            }
        }

        return $wishlist;
    }

}
