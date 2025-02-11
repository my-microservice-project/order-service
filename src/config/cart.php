<?php

return [
    'validation_pipes' => [
        App\Pipeline\Pipes\CartHasProductsPipe::class,
        App\Pipeline\Pipes\ProductStockAvailabilityPipe::class,
        App\Pipeline\Pipes\ProductPriceAvailabilityPipe::class,
    ],
];
