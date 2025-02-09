<?php

namespace App\Services;

use App\Data\Order\AppliedDiscountDTO;
use App\Data\Order\OrderDiscountDetailsDTO;
use App\Models\Order;
use App\Repositories\Contracts\DiscountRepositoryInterface;
use Exception;
use Illuminate\Support\Collection;

class DiscountService
{
    public function __construct(
        protected DiscountRepositoryInterface $discountRepository,
    ) {}

    /**
     * @throws Exception
     */
    public function create(array $discountsData): bool
    {
        try {
            return $this->discountRepository->create($discountsData);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getOrderDiscountDetails(int $orderId): OrderDiscountDetailsDTO
    {
        $order = (app(OrderService::class))->getOrderById($orderId);
        $discounts = $this->calculateDiscounts($order);

        return new OrderDiscountDetailsDTO(
            orderId: $order->id,
            discounts: $discounts,
            totalDiscount: number_format($order->total - $discounts->last()?->subtotal ?? 0, 2),
            discountedTotal: $discounts->last()?->subtotal ?? (float) $order->total
        );
    }


    protected function calculateDiscounts(Order $order): Collection
    {
        $originalTotal = (float) $order->total;
        $subtotal = $originalTotal;
        $discounts = collect();

        foreach ($order->appliedDiscounts()->get() as $discount) {
            $discountAmount = (float) $discount->discount_amount;
            $subtotal -= $discountAmount;

            $discounts->push(new AppliedDiscountDTO(
                discountReason: $discount->campaign_name,
                discountAmount: $discountAmount,
                subtotal: $subtotal
            ));
        }

        return $discounts;
    }


}
