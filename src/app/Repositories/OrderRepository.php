<?php

namespace App\Repositories;

use App\Data\Campaign\DiscountsDTO;
use App\Data\Order\CreatedOrderDTO;
use App\Data\Order\OrderBasicDTO;
use App\Data\Order\OrderDTO;
use App\Data\Order\SyncProductStockDTO;
use App\Enums\QueueEnum;
use App\Exceptions\OrderCanNotCreatedException;
use App\Jobs\CreateDiscountsJob;
use App\Jobs\DecreaseStockJob;
use App\Models\Order;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use BugraBozkurt\InterServiceCommunication\Helpers\AuthHelper;
use Illuminate\Support\Collection;
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
                $order = $this->model->create(OrderBasicDTO::from($orderData)->toArray());

                $this->orderItemRepository->createItems($order, $orderData->items);

                $this->dispatchForSyncStock($orderData->items);

                if (collect($orderData->campaigns->appliedCampaigns)->isNotEmpty()) {

                    $discounts = DiscountsDTO::fromAppliedCampaigns($order->id, $orderData->campaigns->appliedCampaigns);

                    CreateDiscountsJob::dispatch($discounts)->onQueue(QueueEnum::CREATE_DISCOUNTS->getValue());

                }

                return CreatedOrderDTO::from($order);
            });
        } catch (Throwable $e) {
            throw new OrderCanNotCreatedException();
        }
    }

    public function getOrders(): Collection
    {
        return $this->model
            ->where('customer_id', AuthHelper::customerId())
            ->with('items')->get();
    }

    public function getById(int $orderId): Order
    {
        return $this->model->where(
            [
                'id' => $orderId,
                'customer_id' => AuthHelper::customerId()
            ]
        )->firstOrFail();
    }

    public function delete(int $orderId): void
    {
        $this->model->where(
            [
                'id' => $orderId,
                'customer_id' => AuthHelper::customerId()
            ]
        )->delete();
    }

    private function dispatchForSyncStock(Collection $items): void
    {
        $items->map(function ($item) {
            DecreaseStockJob::dispatch($item->product_id, $item->quantity)->onQueue(QueueEnum::DECREASE_STOCK->getValue());
        });
    }

    public function getRevenue(array $customerIds): Collection
    {
        return $this->model
            ->whereIn('customer_id', $customerIds)
            ->selectRaw('sum(total) as revenue, customer_id')
            ->groupBy('customer_id')
            ->get();
    }
}
