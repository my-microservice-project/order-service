<?php

namespace App\Data\Order;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class OrderDiscountDetailsDTO extends Data
{
    public function __construct(
        public int $orderId,
        public Collection $discounts,
        public float $totalDiscount,
        public float $discountedTotal
    ) {}
}
