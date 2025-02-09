<?php

namespace App\Data\Cart;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CartDTO extends Data
{
    public function __construct(
        public readonly Collection $items,
        public readonly int $customerId
    )
    {}
}
