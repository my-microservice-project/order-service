<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
