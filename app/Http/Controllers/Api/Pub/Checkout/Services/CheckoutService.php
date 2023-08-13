<?php

namespace App\Http\Controllers\Api\Pub\Checkout\Services;

use App\Http\Controllers\Api\Pub\Cart\Services\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Checkout\CheckoutRequest;
use App\Mail\WelcomeEmail;
use App\Models\Order;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
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

            DB::commit();

            return Order::query()->findOrFail($orderId);
        } catch (Exception $exception) {
            DB::rollback();
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => "Something goes wrong, " . $exception->getMessage(),
            ]);
        }
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

    public function deleteCartProducts(Model $user)
    {
        try {
            DB::beginTransaction();
            $user->cart()->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => "Something goes wrong, " . $exception->getMessage(),
            ]);
        }
    }

}
