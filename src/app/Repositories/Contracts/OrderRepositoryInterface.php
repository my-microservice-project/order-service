<?php

namespace App\Repositories\Contracts;

use App\Data\Order\CreatedOrderDTO;
use App\Data\Order\OrderDTO;
use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function create(OrderDTO $orderData): CreatedOrderDTO;

    public function getOrders();

    public function getById(int $orderId): Order;

    public function getRevenue(array $customerIds): Collection;
}
