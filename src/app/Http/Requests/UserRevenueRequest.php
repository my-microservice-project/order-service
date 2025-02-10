<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
