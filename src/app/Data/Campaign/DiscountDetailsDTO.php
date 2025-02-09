<?php

namespace App\Data\Campaign;


use Spatie\LaravelData\Data;

class DiscountDetailsDTO extends Data
{
    public function __construct(
        public ?int $productId,
        public ?int $categoryId,
        public ?int $requiredQuantity,
        public ?int $freeQuantity,
        public ?float $unitPrice,
        public ?float $discountAmount,
        public ?float $discountPercentage,
        public ?float $itemPrice
    ) {}
}
