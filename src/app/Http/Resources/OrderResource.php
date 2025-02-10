<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OrderResource",
    title: "Order Resource",
    description: "Order resource representation",
    properties: [
        new OA\Property(property: "id", description: "Order ID", type: "integer"),
        new OA\Property(property: "customerId", description: "Customer ID", type: "integer"),
        new OA\Property(property: "total", description: "Total amount", type: "number", format: "float"),
        new OA\Property(property: "items", description: "List of order items", type: "array", items: new OA\Items(ref: "#/components/schemas/OrderItemResource"))
    ],
    type: "object"
)]
class OrderResource extends JsonResource
{
    public function __construct($resource)
    {
        self::withoutWrapping();
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'customerId' => $this->resource->customer_id,
            'items' => OrderItemResource::collection($this->resource->items),
            'total' => $this->resource->total,
        ];
    }
}
