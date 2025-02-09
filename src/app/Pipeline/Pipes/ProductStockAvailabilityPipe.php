<?php

namespace App\Pipeline\Pipes;

use App\Actions\CheckStockAction;
use App\Data\Cart\CartDTO;
use App\Data\Cart\CartItemDTO;

class ProductStockAvailabilityPipe
{
    public function __construct(protected CheckStockAction $action)
    {}

    public function handle(CartDTO $cart, $next)
    {
        $cart->items->map(function (CartItemDTO $item) {
            $this->action->execute($item->product_id, $item->quantity);
        });

        return $next($cart);
    }
}
