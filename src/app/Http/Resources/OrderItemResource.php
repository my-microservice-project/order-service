<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
