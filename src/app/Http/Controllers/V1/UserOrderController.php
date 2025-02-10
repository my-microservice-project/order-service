<?php

namespace App\Http\Controllers\V1;

use App\Actions\GetUserRevenueAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRevenueRequest;
use Illuminate\Http\JsonResponse;

class UserOrderController extends Controller
{
    public function getUserRevenue(UserRevenueRequest $request, GetUserRevenueAction $action): JsonResponse
    {
        $revenue = $action->execute($request->getUserIds());

        return response()->json([
            'revenue' => $revenue
        ]);
    }
}
