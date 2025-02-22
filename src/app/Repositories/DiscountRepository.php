<?php

namespace App\Repositories;

use App\Models\AppliedDiscounts;
use App\Repositories\Contracts\DiscountRepositoryInterface;

final class DiscountRepository implements DiscountRepositoryInterface
{
    public function __construct(
        protected AppliedDiscounts $model
    ) {}

    public function create(array $discountsData): bool
    {
        foreach ($discountsData as $discount) {
            $this->model->create($discount);
        }

        return true;
    }

    public function getDiscountsTotalByOrderId(int $orderId): float
    {
        return $this->model->where('order_id', $orderId)->sum('discount_amount');
    }

}
