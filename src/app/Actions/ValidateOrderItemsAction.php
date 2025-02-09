<?php

namespace App\Actions;

use App\Data\Cart\CartDTO;
use App\Pipeline\Pipes\CartHasProductsPipe;
use App\Pipeline\Pipes\ProductStockAvailabilityPipe;
use Illuminate\Pipeline\Pipeline;

class ValidateOrderItemsAction
{
    public function execute(CartDTO $cart): void
    {
        app(Pipeline::class)
            ->send($cart)
            ->through([
                CartHasProductsPipe::class,
                ProductStockAvailabilityPipe::class,
            ])
            ->then(function ($payload) {
                return $payload;
            });
    }
}
