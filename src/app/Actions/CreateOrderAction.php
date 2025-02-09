<?php

namespace App\Actions;

use App\Data\Cart\CartDTO;
use App\Data\Order\CreatedOrderDTO;
use App\Services\OrderService;
use Exception;

class CreateOrderAction
{
    public function __construct(
        protected OrderService $orderService
    )
    {}

    /**
     * @throws Exception
     */
    public function execute(CartDTO $cart): CreatedOrderDTO
    {
        (new ValidateOrderItemsAction())->execute($cart);

        return CreatedOrderDTO::from($this->orderService->handle($cart));
    }
}
