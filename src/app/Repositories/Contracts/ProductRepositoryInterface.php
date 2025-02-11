<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function checkStock(int $productId, int $quantity): void;

    public function checkPrice(int $productId, float $unitPrice): void;
}
