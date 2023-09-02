<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Api\Pub\Checkout\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    private PaymentService $service;

    public GatewayInterface $gateway;


    public function __construct(PaymentService $service)
    {
        $this->service = $service;

        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }



    public function charge(Request $request): JsonResponse
    {
        $data = $request->json()->all(); // Получение данных из JSON в теле запроса
        $order = Order::query()->where('id', $data['order'])->first();

        if ($order) {
            try {
                $purchaseData = $this->service->getPurchaseData($order);

                $response = $this->gateway->purchase(array(
                    'amount' => $purchaseData['totalPrice'],
                    'items' => $purchaseData['products'],
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => route('success-payment.index', ['order' => $order->id, 'status' => true]),
                    'cancelUrl' => route('error-payment.index', ['status' => 'false']),
                ))->send();

                if ($response->isRedirect()) {
                    return ResponseService::sendJsonResponse(true, 200, [], [
                        'redirect' => $response->getRedirectUrl(),
                    ]);
                } else {
                    return ResponseService::sendJsonResponse(false, 400, [
                        'error' => $response->getMessage(),
                    ]);
                }
            } catch (Exception $e) {
                return ResponseService::sendJsonResponse(false, 400, [
                    'error' => $e->getMessage(),
                ]);
            }
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'This order does not exist',
            ]);
        }
    }

    public function payment_success(Request $request): JsonResponse
    {
        if ($request->input('paymentId') && $request->input('PayerID') && $request->input('order')) {
            $this->service->payOrder($request->input('order'));

            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $isPaymentExist = Payment::query()->where('payment_id', $arr_body['id'])->first();

                if (!$isPaymentExist) {
                    $this->service->storePayment($arr_body);
                }

                return ResponseService::sendJsonResponse(true, 200, [], [
                    'success' => "Payment is successful. Your transaction id is: " . $arr_body['id'],
                ]);
            } else {
                return ResponseService::sendJsonResponse(false, 400, [
                    'Error' => $response->getMessage(),
                ]);
            }
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Transaction is declined',
            ]);
        }
    }

    public function payment_error()
    {
        return ResponseService::sendJsonResponse(false, 400, [
            'Error' => 'User is canceled to payment',
        ]);
    }


}
