<?php

namespace App\Http\Controllers;

class PaymentController
{
    public function payment_success()
    {
        return 'Payment was successful';
    }

    public function payment_error()
    {
        return 'Payment was bad';
    }
}
