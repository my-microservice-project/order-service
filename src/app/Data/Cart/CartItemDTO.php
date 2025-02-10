<?php
declare(strict_types=1);

namespace App\Data\Cart;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema(
    schema: "CartItemDTO",
    title: "Cart Item DTO",
    description: "Represents a single item in the cart",
    required: ["product_id", "unit_price", "quantity"],
    properties: [
        new OA\Property(property: "product_id", description: "ID of the product", type: "integer"),
        new OA\Property(property: "unit_price", description: "Unit price of the product", type: "number", format: "float"),
        new OA\Property(property: "quantity", description: "Quantity of the product", type: "integer"),
        new OA\Property(property: "line_total", description: "Total price of the item", type: "number", format: "float", nullable: true)
    ],
    type: "object"
)]
class CartItemDTO extends Data
{
    public function __construct(
        public readonly int $product_id,
        public readonly float $unit_price,
        public readonly int $quantity,
        public ?float $line_total = 0,
    ) {}
}
