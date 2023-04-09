<?php

namespace Domain\Order\Payment;

use Illuminate\Support\Collection;

class PaymentData
{
    public function __construct(
        public string $id,
        public string $description,
        public string $returnUrl,
        public string $amount,
        public Collection $meta,
    )
    {
    }
}
