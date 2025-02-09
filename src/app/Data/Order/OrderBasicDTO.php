<?php

namespace App\Data\Order;

use Spatie\LaravelData\Data;

class OrderBasicDTO extends Data
{
    public function __construct(
        public int $customer_id,
        public float $total,
        public float $discounted_total,
    ) {}
}
