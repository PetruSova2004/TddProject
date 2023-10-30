<?php

namespace App\Http\Controllers\Web\Pub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AfterPaymentController extends Controller
{
    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID') && $request->input('order')) {
            return view('Pub.success-payment');
        } else {
            abort(404);
        }
    }

    public function error(Request $request)
    {
        if ($request->input('status')) {
            return view('Pub.error-payment');
        } else {
            abort(404);
        }
    }
}
