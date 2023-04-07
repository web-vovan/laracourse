<?php

namespace Domain\Order\Models;

use Domain\Order\States\Payment\PaymentState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_gateway',
        'payment_id',
        'meta',
    ];

    protected $casts = [
        'meta' => 'collection',
        'state' => PaymentState::class,
    ];
}
