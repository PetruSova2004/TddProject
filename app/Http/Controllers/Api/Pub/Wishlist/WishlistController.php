<?php

namespace App\Http\Controllers\Api\Pub\Wishlist;

use App\Http\Controllers\Api\Pub\Wishlist\Services\WishlistService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Wishlist\WishlistRequest;
use App\Models\Product;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WishlistController extends Controller
{

    private WishlistService $service;

    public function __construct(WishlistService $service)
    {
        $this->service = $service;
    }

    public function get(): JsonResponse
    {
        $wishlist = Cache::get('wishlist');
        if ($wishlist) {
            $wishlistProducts = $this->service->checkCount($wishlist);
            return ResponseService::sendJsonResponse(true, 200, [], [
                'wishlist' => $wishlistProducts,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Empty' => 'Your wishlist is empty',
            ]);
        }
    }

    public function add(WishlistRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $product = $this->service->getProduct($request);
            $existingProducts = $this->service->add($product);
            Cache::put('wishlist', $existingProducts);
            $wishlist = Cache::get('wishlist');

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => "Product " . $product['title'] . " has been successfully added to wishlist",
                'wishlist' => $wishlist,
            ]);
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 401, [
                'Error' => $exception->getMessage(),
            ]);
        }
    }

    public function deleteOne(Request $request): JsonResponse
    {
        $cache = Cache::get('wishlist');
        $product = Product::query()->where('id', $request->input('productId'))->first();
        $match = false;

        if ($cache && $product) {
            foreach ($cache as $key => $item) {
                if ($item['id'] === $product->id) {
                    unset($cache[$key]); // Удаляем элемент из массива
                    Cache::put('wishlist', $cache);
                    $match = true;
                }
            }

            if ($match) {
                return ResponseService::sendJsonResponse(true, 200, [], [
                    'success' => "Product " . $product->title . " has been successfully deleted form wishlist",
                ]);
            } else {
                return ResponseService::sendJsonResponse(false, 400, [
                    'Error' => 'There is no such product in your wishlist',
                ]);
            }

        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'Oops, something goes wrong',
            ]);
        }
    }

    public function clearAll(): JsonResponse
    {
        $wishlistProducts = Cache::get('wishlist');
        if ($wishlistProducts) {
            Cache::forget('wishlist');
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'Your wishlist has been successfully cleared',
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'You wishlist was empty',
            ]);
        }
    }

}
