<?php

namespace Domain\Order\Events;

use Domain\Order\Models\Order;
use Domain\Order\States\OrderState;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Order $order;
    public OrderState $old;
    public OrderState $current;

    public function __construct(Order $order, OrderState $old, OrderState $current)
    {
        $this->order = $order;
        $this->old = $old;
        $this->current = $current;
    }
}
