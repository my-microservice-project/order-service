<?php

namespace App\Repositories;

use App\Data\Cart\CartItemDTO;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use Illuminate\Support\Collection;

final class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function __construct(
        protected OrderItem $model
    ) {}

    public function createItems(Order $order, $items): Collection
    {
        return collect($items)->map(function (CartItemDTO $item) use ($order) {
            return $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total' => $item->line_total,
            ]);
        });
    }
}
