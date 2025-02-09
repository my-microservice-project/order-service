<?php

namespace App\Services;

use App\Data\Cart\CartDTO;
use App\Data\CreatedOrderDTO;
use App\Managers\OrderManager;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Exceptions\OrderCanNotCreatedException;
use Exception;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected OrderManager $orderManager
    ) {}

    /**
     * @throws Exception
     */
    public function handle(CartDTO $cart): CreatedOrderDTO
    {
        try {
            $order = $this->orderManager->loadCartItems($cart->items)
                ->calculateTotalByLine()
                ->setCustomerId($cart->customerId)
                ->loadCampaign($cart)
                ->calculateTotal()
                ->manageOrder();

            return CreatedOrderDTO::from($this->orderRepository->create($order));
        } catch (Exception $e) {
            throw new OrderCanNotCreatedException();
        }
    }
}
