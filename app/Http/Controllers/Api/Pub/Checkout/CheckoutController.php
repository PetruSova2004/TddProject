<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Api\Pub\Checkout\Services\CheckoutService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Checkout\CheckoutRequest;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $service;

    public function __construct(CheckoutService $service)
    {
        $this->service = $service;
    }

    public function placeOrder(CheckoutRequest $request): JsonResponse
    {
        $request->validated();
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
        $order = $this->service->insertOrder($request, $user);
        if ($order) {
            $this->service->sendEmail($user);
            $this->service->deleteCartProducts($user);
            $products = json_decode($order->ordered_products);
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => "Order number " . $order->id . " has been added",
                'ordered_products' => $products,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Something goes wrong'
            ]);
        }
    }
}
