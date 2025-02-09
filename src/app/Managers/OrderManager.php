<?php

namespace App\Managers;

use App\Actions\GetCampaignAction;
use App\Data\Campaign\CampaignResultDTO;
use App\Data\Cart\CartDTO;
use App\Data\OrderDTO;
use Exception;
use Illuminate\Support\Collection;

class OrderManager
{
    protected Collection $orderItems;

    protected int $customerId;

    protected float $total;

    protected CampaignResultDTO $campaigns;

    public function loadCartItems(Collection $items): static
    {
        $this->orderItems = $items;
        return $this;
    }

    public function setCustomerId(int $customerId): static
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function calculateTotal(): static
    {
        $this->total = $this->orderItems->sum(fn(&$item) => $item->unit_price * $item->quantity);
        return $this;
    }

    public function calculateTotalByLine(): static
    {
        $this->orderItems->each(fn(&$item) => $item->line_total = $item->unit_price * $item->quantity);
        return $this;
    }

    public function manageOrder(): OrderDTO
    {
        return new OrderDTO(
            items: $this->orderItems,
            total: $this->total,
            discounted_total: $this->campaigns->finalTotal,
            customer_id: $this->customerId
        );
    }

    /**
     * @throws Exception
     */
    public function loadCampaign(CartDTO $cart): static
    {
        $this->campaigns =  (new GetCampaignAction())->execute($cart);
        return $this;
    }
}
