<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
