<?php

namespace App\Actions;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class GetUserRevenueAction
{
    public function __construct(
       protected OrderRepositoryInterface $orderRepository
    )
    {}

    public function execute(array $customerIds): Collection
    {
        return $this->orderRepository->getRevenue($customerIds);
    }
}
