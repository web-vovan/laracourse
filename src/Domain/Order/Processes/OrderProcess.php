<?php

namespace Domain\Order\Processes;

use Domain\Order\Events\OrderCreated;
use Domain\Order\Models\Order;
use DomainException;
use Illuminate\Pipeline\Pipeline;
use Support\Transaction;
use Throwable;

class OrderProcess
{
    protected array $processes = [];

    public function __construct(
        protected Order $order
    )
    {
    }

    public function processes(array $processes): self
    {
        $this->processes = $processes;

        return $this;
    }

    /**
     * @return Order
     * @throws Throwable
     */
    public function run()
    {
         return Transaction::run(function () {
            return app(Pipeline::class)
                ->send($this->order)
                ->through($this->processes)
                ->thenReturn();
         }, function() {
            flash()->info('Good #' . $this->order->id);

            event(new OrderCreated($this->order));
         }, function(Throwable $e) {
             throw new DomainException($e->getMessage());
         });
    }
}
