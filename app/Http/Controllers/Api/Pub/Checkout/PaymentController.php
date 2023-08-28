<?php

namespace App\Http\Controllers\Api\Pub\Checkout;

use App\Http\Controllers\Api\Pub\Checkout\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;

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

    public function confirmOrder(Request $request, $orderId)
    {
        try {
            $order = Order::query()->where('id', $orderId)->firstOrFail();
            $order->status = 'Approved';
            $order->save();
            return redirect()->route('home')->with('success', 'Your order was successfully approved');
        } catch (Exception $exception) {
            return redirect()->route('home')->with('error', $exception->getMessage());
        }

    }

    public function charge(Request $request)
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
//                    'returnUrl' => route('api.paymentSuccess', ['orderId' => $order->id]),
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
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
        }
    }

    public function payment_success(Request $request, $orderId)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
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
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();
                }


                return ResponseService::sendJsonResponse(true, 200, [], [
                    'success' => "Payment is successful. Your transaction id is: " . $arr_body['id'],
                ]);
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function payment_error()
    {
        return 'User is canceled the payment.';
    }
}
