<?php

namespace App\Actions;

use App\Repositories\Contracts\ProductRepositoryInterface;

class CheckPriceAction
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function execute(int $productId, float $unitPrice): void
    {
        $this->productRepository->checkPrice($productId, $unitPrice);
    }
}
