<?php

namespace Domain\Order\States;

class PaidOrderState extends OrderState
{
    protected array $allowedTransitions = [
        CancelledOrderState::class
    ];

    public function canBeChange(): bool
    {
        return true;
    }

    public function value(): string
    {
        return 'paid';
    }

    public function humanValue(): string
    {
        return 'Оплачен';
    }
}
