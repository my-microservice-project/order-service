<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CreatedOrderResource",
    title: "Created Order Resource",
    description: "Resource representation of a created order",
    properties: [
        new OA\Property(property: "id", type: "integer", description: "Order ID"),
        new OA\Property(property: "total", type: "number", format: "float", description: "Total amount of the order"),
        new OA\Property(property: "discounted_total", type: "number", format: "float", description: "Total amount after discounts"),
        new OA\Property(property: "success", type: "boolean", description: "Indicates if the order was successfully created")
    ],
    type: "object"
)]
class CreatedOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'total' => $this->resource->total,
            'discounted_total' => $this->resource->discounted_total,
        ];
    }
}
