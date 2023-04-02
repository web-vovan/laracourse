<?php

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Exceptions\OrderProcessException;
use Domain\Order\Models\Order;

class CheckProductQuantities implements OrderProcessContract
{
    /**
     * @param Order $order
     * @param $next
     * @return mixed
     * @throws OrderProcessException
     */
    public function handle(Order $order, $next): mixed
    {
        foreach (cart()->items() as $item) {
            if ($item->product->quantity < $item->quantity) {
                throw new OrderProcessException('Недостаточно товара на складе');
            }
        }

        return $next($order);
    }
}
