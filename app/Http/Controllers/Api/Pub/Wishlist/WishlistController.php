<?php

namespace App\Http\Controllers\Api\Pub\Wishlist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Wishlist\WishlistRequest;
use App\Models\Product;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WishlistController extends Controller
{
    public function add(WishlistRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $existingProducts = Cache::get('wishlist');
            $product = Product::query()->where('id', $request->input('productId'))->first();
            $match = false;

            if ($existingProducts) {
                foreach ($existingProducts as $item) {
                    if ($item->id === $product->id) {
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

            Cache::put('wishlist', $existingProducts);
            $wishlist = Cache::get('wishlist');

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => "Product " . $product->title . " has been successfully added to wishlist",
                'wishlist' => $wishlist,
            ]);
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 401, [
                'Error' => $exception->getMessage(),
            ]);
        }
    }
}
