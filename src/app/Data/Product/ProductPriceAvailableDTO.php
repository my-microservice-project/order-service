<?php

namespace App\Data\Product;

use Spatie\LaravelData\Data;

class ProductPriceAvailableDTO extends Data
{
    public function __construct(
        public int $productId,
        public float $price
    )
    {}
}
