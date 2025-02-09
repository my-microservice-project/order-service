<?php

namespace App\Repositories\Contracts;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderItemRepositoryInterface
{
    public function createItems(Order $order, $items): Collection;
}
