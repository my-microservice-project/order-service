<?php

namespace App\Actions;

use App\Data\Cart\CartDTO;
use Illuminate\Pipeline\Pipeline;

class ValidateOrderItemsAction
{
    public function execute(CartDTO $cart): void
    {
        app(Pipeline::class)
            ->send($cart)
            ->through(config('cart.validation_pipes'))
            ->then(function ($payload) {
                return $payload;
            });
    }
}
