<?php

namespace App\Http\Controllers\V1;

use App\Actions\CreateOrderAction;
use App\Actions\GetOrdersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\CreatedOrderResource;
use App\Http\Resources\OrderResource;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{

    public function index(GetOrdersAction $action): AnonymousResourceCollection
    {
        $orders = $action->execute();
        return OrderResource::collection($orders);
    }

    /**
     * @throws Exception
     */
    public function store(CreateOrderRequest $request, CreateOrderAction $action): CreatedOrderResource
    {
        $createdOrder = $action->execute($request->payload());
        return CreatedOrderResource::make($createdOrder)->additional(['success'=> true]);
    }
}
