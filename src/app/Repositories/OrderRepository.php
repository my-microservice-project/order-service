<?php

namespace App\Repositories;

use App\Data\CreatedOrderDTO;
use App\Data\OrderDTO;
use App\Exceptions\OrderCanNotCreatedException;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class OrderRepository implements OrderRepositoryInterface
{
    public function __construct(
        private Order $model,
        private OrderItemRepositoryInterface $orderItemRepository
    ) {}

    /**
     * @throws OrderCanNotCreatedException
     */
    public function create(OrderDTO $orderData): CreatedOrderDTO
    {
        try {
            return DB::transaction(function () use ($orderData) {
                $order = $this->model->create([
                    'customer_id' => $orderData->customer_id,
                    'total' => $orderData->total,
                    'discounted_total' => $orderData->discounted_total,
                ]);

                $this->orderItemRepository->createItems($order, $orderData->items);

                return CreatedOrderDTO::from($order);
            });
        } catch (Throwable $e) {
            throw new OrderCanNotCreatedException();
        }
    }
}
