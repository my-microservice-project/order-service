<?php

namespace App\Data\Order;

use Spatie\LaravelData\Data;

class OrderItemDTO extends Data
{
    public function __construct(
        public int $product_id,
        public int $quantity,
        public float $unit_price,
        public float $total
    )
    {}
}
