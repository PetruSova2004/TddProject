<?php

namespace App\Http\Controllers\Api\Pub\Checkout\Services;

use App\Events\DeleteAllCartProducts;
use App\Http\Controllers\Api\Pub\Cart\Services\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Checkout\CheckoutRequest;
use App\Mail\WelcomeEmail;
use App\Models\Order;
use App\Services\Response\ResponseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutService extends Controller
{
    public function insertOrder(CheckoutRequest $request, Model $user)
    {
        $cartService = new CartService();
        $carts = $cartService->getUserCart($user);

        if ($carts) {
            try {
                DB::beginTransaction(); // Начало транзакции
                $orderData = [
                    'user_id' => Auth::user()->getAuthIdentifier(),
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'price' => $request->input('price'),
                    'company' => $request->input('company'),
                    'country' => $request->input('country'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'ZIP' => $request->input('zip'),
                    'status' => 'Pending',
                    'ordered_products' => json_encode($carts),
                ];
                $orderId = DB::table('orders')->insertGetId($orderData); // Вставка и получение ID
                event(new DeleteAllCartProducts($user));
                DB::commit();

                return Order::query()->findOrFail($orderId);
            } catch (Exception $exception) {
                DB::rollback();
                return ResponseService::sendJsonResponse(false, 407, [
                    'Error' => "Something goes wrong, " . $exception->getMessage(),
                ]);
            }
        } else {
            return false;
        }
    }

    public function getOrderTotalPrice($order): int
    {
        $products = json_decode($order->ordered_products);
        $price = 0;
        foreach ($products as $product) {
            $price += $product->quantity * $product->price_x1;
        }
        return $price;
    }

    public function sendEmail(Model $user): bool|JsonResponse
    {
        $userEmail = $user->email;
        try {
            Mail::to($userEmail)->send(new WelcomeEmail());
            return true;
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => "Something goes wrong, " . $exception->getMessage(),
            ]);
        }
    }

    public function getFormatedOrders($orders)
    {
        return $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'firstname' => $order->firstname,
                'lastname' => $order->lastname,
                'email' => $order->email,
                'phone' => $order->phone,
                'price' => $order->price,
                'company' => $order->company,
                'country' => $order->country,
                'address' => $order->address,
                'city' => $order->city,
                'zip' => $order->zip,
                'status' => $order->status,
                'ordered_products' => $order->ordered_products,
                'created_at' => Carbon::parse($order->created_at)->toDateString(), // Форматирование даты
            ];
        });
    }

}
