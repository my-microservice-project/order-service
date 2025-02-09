<?php

namespace App\Repositories\Contracts;

use App\Data\Order\CreatedOrderDTO;
use App\Data\Order\OrderDTO;

interface OrderRepositoryInterface
{
    public function create(OrderDTO $orderData): CreatedOrderDTO;
}
