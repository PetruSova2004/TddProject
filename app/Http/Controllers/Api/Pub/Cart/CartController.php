<?php

namespace App\Http\Controllers\Api\Pub\Cart;

use App\Http\Controllers\Api\Pub\Cart\Services\CartService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    private $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function cartGet(): JsonResponse
    {
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
        $cart = $this->service->getUserCart($user);

        if ($cart) {
            $cartCount = count($cart);
            $coupons = $user->coupons;

            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price_x1'] * $item['quantity'];
            }

            if ($coupons->count() > 0) {
                $priceData = $this->service->calcPriceWithDiscount($coupons, $totalPrice);

                return ResponseService::sendJsonResponse(true, 200, [], [
                    'cart' => $cart,
                    'count' => $cartCount,
                    'totalPrice' => $totalPrice,
                    'priceWithDiscount' => floor($priceData['priceWithDiscount']),
                    'discountPercent' => $priceData['totalPercent']
                ]);
            } else {
                return ResponseService::sendJsonResponse(true, 200, [], [
                    'cart' => $cart,
                    'count' => $cartCount,
                    'totalPrice' => $totalPrice,
                ]);
            }
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
                $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
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
                    'There are no more such products in stock',
                ]);
            }

        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Bad product_id or quantity'
            ]);
        }
    }

    public function cartDelete(Request $request): JsonResponse
    {
        $product = Product::query()->where('id', $request->input('productId'))->first();
        $quantity = $request->input('quantity');
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();

        if ($product && $user) {
            $cartItems = $this->service->getSpecificCartProducts($product->id, $user);
            if ($cartItems->get()->isNotEmpty()) {
                $cartItems->delete();
                $product->count += $quantity;
                $product->save();


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
