<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OrderDiscountsResource",
    title: "Order Discounts Resource",
    description: "Resource representation of an order's discounts",
    properties: [
        new OA\Property(property: "orderId", description: "ID of the order", type: "integer"),
        new OA\Property(
            property: "discounts",
            description: "List of applied discounts",
            type: "array",
            items: new OA\Items(ref: "#/components/schemas/OrderDiscountItemResource")
        ),
        new OA\Property(property: "totalDiscount", description: "Total discount amount", type: "number", format: "float"),
        new OA\Property(property: "discountedTotal", description: "Total amount after discount", type: "number", format: "float"),
    ],
    type: "object"
)]
class OrderDiscountsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'orderId' => $this->resource->orderId,
            'discounts' => OrderDiscountItemResource::collection($this->resource->discounts),
            'totalDiscount' => $this->resource->totalDiscount,
            'discountedTotal' => $this->resource->discountedTotal,
        ];
    }
}
