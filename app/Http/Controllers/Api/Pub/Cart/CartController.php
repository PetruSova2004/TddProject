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
                $totalPrice += $item['price-x1'];
            }

            return ResponseService::sendJsonResponse(true, 200, [], [
                'cart' => $cart,
                'count' => $cartCount,
                'totalPrice' => $totalPrice,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Empty' => "No cart products found for the user.",
            ]);
        }
    }

    public function cartAdd(Request $request): JsonResponse
    {
        $productId = Product::query()->where('id', $request->input('productId'))->value('id');
        $quantity = $request->input('quantity');

        if ($productId && $quantity) {
            $user = Auth::user();
            $this->service->addProductsToCart($productId, $quantity, $user);
            $cart = $this->service->getUserCart($user);

            return ResponseService::sendJsonResponse(true, 200, [], [
                'message' => 'Product has been added to cart successfully',
                'cart' => $cart,
            ]);
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

}
