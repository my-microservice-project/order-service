<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OrderItemResource",
    title: "Order Item Resource",
    description: "Details of an item in an order",
    properties: [
        new OA\Property(property: "productId", description: "Product ID", type: "integer"),
        new OA\Property(property: "quantity", description: "Quantity of the product", type: "integer"),
        new OA\Property(property: "unitPrice", description: "Unit price of the product", type: "number", format: "float"),
        new OA\Property(property: "total", description: "Total price of the item", type: "number", format: "float"),
    ],
    type: "object"
)]
class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->resource->product_id,
            'quantity' => $this->resource->quantity,
            'unitPrice' => $this->resource->unit_price,
            'total' => $this->resource->total,
        ];
    }
}
