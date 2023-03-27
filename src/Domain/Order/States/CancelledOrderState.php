<?php

namespace Domain\Order\States;

class CancelledOrderState extends OrderState
{

    protected array $allowedTransitions = [];

    public function canBeChange(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'cancelled';
    }

    public function humanValue(): string
    {
        return 'Отменен';
    }
}
