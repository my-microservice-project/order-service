<?php

namespace App\Actions;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class GetOrdersAction
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    )
    {}

    public function execute(): Collection
    {
        return $this->orderRepository->getOrders();
    }
}
