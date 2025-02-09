<?php

namespace App\Data\Product;

use Spatie\LaravelData\Data;

class ProductStockAvailableDTO extends Data
{
    public function __construct(
        public int $productId,
        public int $quantity
    )
    {}
}
