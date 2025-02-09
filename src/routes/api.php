<?php

use App\Http\Controllers\V1\OrderController;
use App\Http\Middleware\TokenValidationMiddleware;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware(TokenValidationMiddleware::class)->group(function () {
    Route::post('orders', [OrderController::class, 'store']);
});
