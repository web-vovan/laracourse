<?php

namespace Domain\Order\DTO;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class NewOrderDTO
{
    use Makeable;

    public function __construct(
        public array $customer,
        public ?string $password,
        public int $delivery_type_id,
        public int $payment_method_id,
        public bool $create_account
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        $data = $request->only([
            'customer.first_name',
            'customer.last_name',
            'customer.email',
            'customer.phone',
            'customer.city',
            'customer.address',
            'password',
            'delivery_type_id',
            'payment_method_id',
        ]);

        $data['create_account'] = (bool) $request->get('create_account');

        return static::make(...$data);
    }
}
