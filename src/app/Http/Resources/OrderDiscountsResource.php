<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
