<?php

namespace App\Http\Controllers\Api\Pub\Checkout\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentService extends Controller
{
    public function getPurchaseData($order)
    {
        $products = json_decode($order->ordered_products);
        $x = [];
        $totalPrice = 0;

        foreach ($products as $product) {
            $x[] = [
                'title' => $product->title,
                'price' => floor($product->price_x1),
                'quantity' => $product->quantity,
            ];
        }
        foreach ($x as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return [
            'products' => $x,
            'totalPrice' => $totalPrice,
        ];
    }
}
