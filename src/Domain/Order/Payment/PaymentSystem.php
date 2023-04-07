<?php

namespace Domain\Order\Payment;

use Domain\Order\Contracts\PaymentGatewayContract;

class PaymentSystem
{
    public static PaymentGatewayContract $provider;
}
