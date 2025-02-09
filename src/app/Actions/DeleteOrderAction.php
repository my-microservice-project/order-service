<?php

namespace App\Actions;

use App\Repositories\OrderRepository;

class DeleteOrderAction
{
    public function __construct(
        protected OrderRepository $orderRepository
    )
    {}

    public function execute(int $orderId): void
    {
        $this->orderRepository->delete($orderId);
    }
}
