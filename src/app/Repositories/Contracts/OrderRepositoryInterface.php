<?php

namespace App\Repositories\Contracts;

use App\Data\CreatedOrderDTO;
use App\Data\OrderDTO;

interface OrderRepositoryInterface
{
    public function create(OrderDTO $orderData): CreatedOrderDTO;
}
