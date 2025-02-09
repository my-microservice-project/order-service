<?php

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class OrderDTO extends Data
{
    public function __construct(
        public Collection $items,
        public float $total,
        public float $discounted_total,
        public int $customer_id
    ) {}
}
