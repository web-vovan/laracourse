<?php

namespace Domain\Order\Actions;

use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTO\NewUserDTO;
use Domain\Order\DTO\NewOrderDTO;
use Domain\Order\Models\Order;

class NewOrderAction
{
    public function __invoke(NewOrderDTO $dto): Order
    {
        if ($dto->create_account) {
            $registerAction = app(RegisterNewUserContract::class);

            $registerAction(new NewUserDTO(
                $dto->customer['first_name'] . ' ' . $dto->customer['last_name'],
                $dto->customer['email'],
                $dto->password
            ));
        }

        return Order::query()->create([
            'payment_method_id' => $dto->payment_method_id,
            'delivery_type_id' => $dto->delivery_type_id,
        ]);
    }
}
