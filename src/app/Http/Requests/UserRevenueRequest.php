<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UserRevenueRequest",
    title: "User Revenue Request",
    description: "Request payload for retrieving revenue of multiple users",
    required: ["user_ids"],
    properties: [
        new OA\Property(
            property: "user_ids",
            description: "List of user IDs",
            type: "array",
            items: new OA\Items(type: "integer")
        )
    ],
    type: "object"
)]
class UserRevenueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_ids' => 'required|array',
            'user_ids.*' => 'required|integer'
        ];
    }

    public function getUserIds(): array
    {
        return $this->validated('user_ids');
    }
}
