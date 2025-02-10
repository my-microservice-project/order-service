<?php

namespace App\Http\Requests;

use App\Data\Cart\CartDTO;
use App\Data\Cart\CartItemDTO;
use BugraBozkurt\InterServiceCommunication\Exceptions\UnauthorizedException;
use BugraBozkurt\InterServiceCommunication\Helpers\AuthHelper;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "CreateOrderRequest",
    title: "Create Order Request",
    description: "Request payload for creating a new order",
    required: ["items"],
    properties: [
        new OA\Property(
            property: "items",
            description: "List of items in the order",
            type: "array",
            items: new OA\Items(ref: "#/components/schemas/CartItemDTO")
        )
    ],
    type: "object"
)]
class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ];
    }

    /**
     * @throws UnauthorizedException
     */
    public function payload(): CartDTO
    {
        $cartItems = collect($this->validated()['items'])
            ->map(fn($item) => CartItemDTO::from($item));

        return CartDTO::from(
            [
                'items' => $cartItems,
                'customerId' => AuthHelper::customerId()
            ]
        );
    }
}
