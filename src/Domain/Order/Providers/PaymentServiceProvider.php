<?php

namespace Domain\Order\Providers;

use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        PaymentSystem::onCreating(function (PaymentData $paymentData) {
            return $paymentData;
        });
    }

    public function register(): void
    {

    }
}
