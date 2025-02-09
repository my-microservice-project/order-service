<?php

namespace App\Actions;

use App\Data\Order\OrderDiscountDetailsDTO;
use App\Services\DiscountService;

class GetOrderDiscountsAction
{
    public function __construct(protected DiscountService $discountService)
    {}

    public function execute(int $orderId): OrderDiscountDetailsDTO
    {
        return $this->discountService->getOrderDiscountDetails($orderId);
    }
}
