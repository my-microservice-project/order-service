<?php

namespace App\Http\Controllers\V1;

use App\Actions\CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use Exception;

class OrderController extends Controller
{
    /**
     * @throws Exception
     */
    public function store(CreateOrderRequest $request, CreateOrderAction $action): OrderResource
    {
        $createdOrder = $action->execute($request->payload());
        return OrderResource::make($createdOrder)->additional(['success'=> true]);
    }
}
