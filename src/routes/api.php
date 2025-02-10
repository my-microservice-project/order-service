<?php

use App\Http\Controllers\V1\OrderController;
use App\Http\Controllers\V1\UserOrderController;
use App\Http\Middleware\TokenValidationMiddleware;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::middleware(TokenValidationMiddleware::class)->prefix('orders')->group(function () {
        Route::resource('orders', OrderController::class)->only(['index','store','destroy']);
        Route::get('orders/{orderId}/discounts', [OrderController::class, 'getDiscounts']);
    });

    Route::prefix('users')->group(function () {
        Route::post('revenue', [UserOrderController::class, 'getUserRevenue']);
    });

});
