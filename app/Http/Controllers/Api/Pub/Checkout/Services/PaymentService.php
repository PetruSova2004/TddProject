<?php

namespace App\Http\Controllers\Api\Pub\Checkout\Services;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentService extends Controller
{
    public function getPurchaseData($order): array
    {
        $products = json_decode($order->ordered_products);
        $discount = $order->discount;

        $x = [];
        $totalPrice = 0;

        if ($discount > 0) {
            foreach ($products as $product) {
                $x[] = [
                    'title' => $product->title,
                    'price' => floor($product->price_x1) * (1 - ($discount / 100)), // Цена со скидкой для одной единицы
                    'quantity' => $product->quantity,
                ];
            }
        } else {
            foreach ($products as $product) {
                $x[] = [
                    'title' => $product->title,
                    'price' => floor($product->price_x1),
                    'quantity' => $product->quantity,
                ];
            }
        }
        foreach ($x as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return [
            'products' => $x,
            'totalPrice' => $totalPrice,
        ];
    }

    public function storePayment($arr_body): void
    {
        Payment::query()->insert([
            'payment_id' => $arr_body['id'],
            'payer_id' => $arr_body['payer']['payer_info']['payer_id'],
            'payer_email' => $arr_body['payer']['payer_info']['email'],
            'amount' => $arr_body['transactions'][0]['amount']['total'],
            'currency' => env('PAYPAL_CURRENCY'),
            'payment_status' => $arr_body['state'],
        ]);
    }

    public function approveOrder($orderId): JsonResponse
    {
        try {
            $order = Order::query()->where('id', $orderId)->first();

            if ($order->status === 'Pending') {
                $order->status = 'Approved';
                $order->save();

                return ResponseService::sendJsonResponse(true, 200, [], [
                    'success' => 'Order has been successfully updated'
                ]);
            } else {
                return ResponseService::sendJsonResponse(false, 400, [
                    'error' => 'Order is not waiting for confirmation'
                ]);
            }
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => $exception->getMessage(),
            ]);
        }
    }

    public function payOrder($orderId): bool|JsonResponse
    {
        try {
            $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
            $coupons = $user->coupons;

            foreach ($coupons as $coupon) {
                DB::table('coupon_user')
                    ->where('user_id', $user->id)
                    ->where('coupon_id', $coupon->id)
                    ->delete();
            }

            $order = Order::query()->where('id', $orderId)->first();
            $order->status = 'Paid';
            $order->save();

            return true;
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => $exception->getMessage(),
            ]);
        }
    }

}
