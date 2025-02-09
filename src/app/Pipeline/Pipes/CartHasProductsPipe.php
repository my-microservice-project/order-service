<?php

namespace App\Pipeline\Pipes;

use App\Data\Cart\CartDTO;
use App\Exceptions\CartIsEmptyException;
use Closure;

class CartHasProductsPipe
{
    /**
     * @throws CartIsEmptyException
     */
    public function handle(CartDTO $cart, Closure $next)
    {
        if ($cart->items->isEmpty()) {
            throw new CartIsEmptyException();
        }

        return $next($cart);
    }
}
