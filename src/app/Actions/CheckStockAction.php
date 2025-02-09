<?php

namespace App\Actions;

use App\Repositories\Contracts\ProductRepositoryInterface;

class CheckStockAction
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    )
    {}

    public function execute(int $productId, int $quantity): void
    {
        $this->productRepository->checkStock($productId, $quantity);
    }
}
