<?php

namespace App\Data\Order;

use Spatie\LaravelData\Data;

class CreatedOrderDTO extends Data
{
    public function __construct(
        public int $id,
        public float $total,
        public float $discounted_total,
    ) {}
}
