<?php

namespace App\Repositories\Contracts;

interface DiscountRepositoryInterface
{
    public function create(array $discountsData): bool;

    public function getDiscountsTotalByOrderId(int $orderId): float;
}
