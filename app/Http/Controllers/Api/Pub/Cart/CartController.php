<?php

namespace App\Http\Controllers\Api\Pub\Cart;

use App\Http\Controllers\Api\Pub\Cart\Services\CartService;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    private $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function cartGet(Request $request)
    {
        $user = Auth::user();
        $cart = $this->service->getUserCart($user);

        if ($cart) {
            $cartCount = count($cart);

            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price_x1'];
            }

            return ResponseService::sendJsonResponse(true, 200, [], [
                'cart' => $cart,
                'count' => $cartCount,
                'totalPrice' => $totalPrice,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 200, [
                'Empty' => "No cart products found for the user.",
            ]);
        }
    }

    public function cartAdd(Request $request): JsonResponse
    {
        $product = Product::query()->where('id', $request->input('productId'))->first();
        $quantity = $request->input('quantity');

        if ($product->id && $quantity) {
            if ($product->count >= $quantity) {
                $user = Auth::user();
                $this->service->addProductsToCart($product->id, $quantity, $user);
                $cart = $this->service->getUserCart($user);

                $product->count -= $quantity;
                $product->save();

                return ResponseService::sendJsonResponse(true, 200, [], [
                    'message' => 'Product has been added to cart successfully',
                    'cart' => $cart,
                ]);
            } else {
                return ResponseService::sendJsonResponse(false, 200, [
                    'There is no more such products in stock',
                ]);
            }

        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Bad product_id or quantity'
            ]);
        }
    }

    public function cartDelete(Request $request)
    {
        $productId = Product::query()->where('id', $request->input('productId'))->value('id');
        $user = Auth::user();
        if ($productId && $user) {
            $cartItems = $this->service->getSpecificCartProducts($productId, $user);
            if ($cartItems->get()->isNotEmpty()) {
                $cartItems->delete();
                return ResponseService::sendJsonResponse(true, 200, [], [
                    'message' => 'Products have been successfully deleted',
                ]);
            } else {
                return ResponseService::sendJsonResponse(false, 400, [
                    'Product' => 'This product dont exist in your cart',
                ]);
            }

        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Issue' => 'Something is wrong with received productId or Authorization',
            ]);
        }
    }

    public function automaticDelete()
    {

    }

}
