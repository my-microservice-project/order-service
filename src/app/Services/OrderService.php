<?php

namespace App\Services;

use App\Data\Cart\CartDTO;
use App\Data\Order\CreatedOrderDTO;
use App\Exceptions\OrderCanNotCreatedException;
use App\Managers\OrderManager;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
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

    public function getOrderById(int $orderId): Order
    {
        return $this->orderRepository->getById($orderId);
    }
}
