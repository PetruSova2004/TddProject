<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Api\Pub\Checkout\Services\CheckoutService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Checkout\CheckoutRequest;
use App\Models\User;
use App\Services\Response\ResponseService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Pub\Cart\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $service;
    private $cartService;

    public function __construct(CheckoutService $service, CartService $cartService)
    {
        $this->service = $service;
        $this->cartService = $cartService;
    }

    public function placeOrder(CheckoutRequest $request): JsonResponse
    {
        $request->validated();
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
        $order = $this->service->insertOrder($request, $user);

        if ($order) {
            $this->service->sendEmail($user);
            $products = json_decode($order->ordered_products);

            $totalPrice = $this->service->getOrderTotalPrice($order);
            $discount = $this->cartService->calcPriceWithDiscount($user->coupons, $totalPrice);

            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => "Order number " . $order->id . " has been added",
                'ordered_products' => $products,
                'totalPrice' => $totalPrice,
                'discountPrice' => floor($discount['priceWithDiscount']),
                'discountPercent' => floor($discount['totalPercent']),
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Something goes wrong'
            ]);
        }
    }

    public function getOrder(Request $request): JsonResponse
    {
        $user = $request->user();
        $orders = $user->orders;
        $orders->makeHidden([
            'user_id',
            'updated_at',
        ]);

        $formattedOrders = $this->service->getFormatedOrders($orders);

        if (!$orders->isEmpty()) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'orders' => $formattedOrders,
                'count' => $orders->count(),
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'empty' => 'You dont have active orders',
            ]);
        }
    }

}
