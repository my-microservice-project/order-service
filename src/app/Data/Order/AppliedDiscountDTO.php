<?php

namespace App\Data\Order;

use Spatie\LaravelData\Data;

class AppliedDiscountDTO extends Data
{
    public function __construct(
        public string $discountReason,
        public float $discountAmount,
        public float $subtotal
    ) {}
}
