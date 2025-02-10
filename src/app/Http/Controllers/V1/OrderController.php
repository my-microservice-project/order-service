<?php

namespace App\Http\Controllers\V1;

use App\Actions\CreateOrderAction;
use App\Actions\DeleteOrderAction;
use App\Actions\GetOrderDiscountsAction;
use App\Actions\GetOrdersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\CreatedOrderResource;
use App\Http\Resources\OrderDiscountsResource;
use App\Http\Resources\OrderResource;
use BugraBozkurt\InterServiceCommunication\Exceptions\UnauthorizedException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    bearerFormat: "JWT",
    scheme: "bearer"
)]
class OrderController extends Controller
{
    #[OA\Get(
        path: "/api/v1/orders",
        description: "Retrieves a list of all orders",
        summary: "Get all orders",
        security: [
            ["bearerAuth" => []]
        ],
        tags: ["Orders"],
        responses: [
            new OA\Response(response: 200, description: "Successful response", content: new OA\JsonContent(type: "array", items: new OA\Items(ref: "#/components/schemas/OrderResource"))),
            new OA\Response(response: 500, description: "Internal Server Error")
        ]
    )]
    public function index(GetOrdersAction $action): AnonymousResourceCollection
    {
        $orders = $action->execute();
        return OrderResource::collection($orders);
    }

    /**
     * @throws UnauthorizedException
     * @throws Exception
     */
    #[OA\Post(
        path: "/api/v1/orders",
        description: "Creates a new order and returns the created order details",
        summary: "Create a new order",
        security: [
            ["bearerAuth" => []]
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateOrderRequest")
        ),
        tags: ["Orders"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Order created",
                content: new OA\JsonContent(ref: "#/components/schemas/CreatedOrderResource")
            ),
            new OA\Response(response: 400, description: "Bad Request"),
            new OA\Response(response: 500, description: "Internal Server Error")
        ]
    )]
    public function store(CreateOrderRequest $request, CreateOrderAction $action): CreatedOrderResource
    {
        $createdOrder = $action->execute($request->payload());
        return CreatedOrderResource::make($createdOrder)->additional(['success'=> true]);
    }


    #[OA\Delete(
        path: "/api/v1/orders/{orderId}",
        description: "Deletes an order by its ID",
        summary: "Delete an order",
        security: [
            ["bearerAuth" => []]
        ],
        tags: ["Orders"],
        parameters: [
            new OA\Parameter(name: "orderId", description: "Order ID to delete", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Order deleted successfully", content: new OA\JsonContent(type: "object", properties: [new OA\Property(property: "success", type: "boolean")])),
            new OA\Response(response: 404, description: "Order not found"),
            new OA\Response(response: 500, description: "Internal Server Error")
        ]
    )]
    public function destroy(int $orderId, DeleteOrderAction $action): JsonResponse
    {
        $action->execute($orderId);
        return response()->json(['success' => true]);
    }

    #[OA\Get(
        path: "/api/v1/orders/{orderId}/discounts",
        description: "Retrieves all discounts applied to an order",
        summary: "Get discounts for an order",
        security: [
            ["bearerAuth" => []]
        ],
        tags: ["Orders"],
        parameters: [
            new OA\Parameter(name: "orderId", description: "Order ID to get discounts for", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Discounts retrieved successfully", content: new OA\JsonContent(ref: "#/components/schemas/OrderDiscountsResource")),
            new OA\Response(response: 404, description: "Order not found"),
            new OA\Response(response: 500, description: "Internal Server Error")
        ]
    )]
    public function getDiscounts(int $orderId, GetOrderDiscountsAction $action): OrderDiscountsResource
    {
        $orders = $action->execute($orderId);
        return OrderDiscountsResource::make($orders);
    }
}
