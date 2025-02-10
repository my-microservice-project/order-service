<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "OrderDiscountItemResource",
    title: "Order Discount Item Resource",
    description: "Details of a discount applied to an order",
    properties: [
        new OA\Property(property: "discountReason", type: "string", description: "Reason for the discount"),
        new OA\Property(property: "discountAmount", type: "number", format: "float", description: "Amount of discount applied"),
        new OA\Property(property: "subtotal", type: "number", format: "float", description: "Subtotal before discount"),
    ],
    type: "object"
)]
class OrderDiscountItemResource extends JsonResource
{
    public function __construct($resource)
    {
        self::withoutWrapping();
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'discountReason' => $this->resource->discountReason,
            'discountAmount' => $this->formatAmount($this->resource->discountAmount),
            'subtotal' => $this->formatAmount($this->resource->subtotal),
        ];
    }

    private function formatAmount($amount): string
    {
        return number_format(floor($amount * 100) / 100, 2, '.', '');
    }
}
