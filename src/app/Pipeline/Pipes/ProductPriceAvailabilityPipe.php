<?php

namespace App\Pipeline\Pipes;

use App\Actions\CheckPriceAction;
use App\Data\Cart\CartDTO;
use App\Data\Cart\CartItemDTO;

class ProductPriceAvailabilityPipe
{
    public function __construct(protected CheckPriceAction $action)
    {}
    public function handle(CartDTO $cart, $next)
    {
        $cart->items->map(function (CartItemDTO $item) {
            $this->action->execute($item->product_id, $item->unit_price);
        });

        return $next($cart);
    }
}
