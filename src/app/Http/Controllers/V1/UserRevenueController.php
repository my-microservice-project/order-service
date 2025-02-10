<?php

namespace App\Http\Controllers\V1;

use App\Actions\GetUserRevenueAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRevenueRequest;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class UserRevenueController extends Controller
{
    #[OA\Post(
        path: "/api/v1/users/revenue",
        description: "Retrieves revenue information for multiple users",
        summary: "Get revenue for users",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UserRevenueRequest")
        ),
        tags: ["Users Revenue"],
        responses: [
            new OA\Response(response: 200, description: "Revenue retrieved successfully", content: new OA\JsonContent(type: "object", properties: [new OA\Property(property: "revenue", type: "number", format: "float")])),
            new OA\Response(response: 400, description: "Bad Request"),
            new OA\Response(response: 500, description: "Internal Server Error")
        ]
    )]
    public function getUserRevenue(UserRevenueRequest $request, GetUserRevenueAction $action): JsonResponse
    {
        $revenue = $action->execute($request->getUserIds());

        return response()->json([
            'revenue' => $revenue
        ]);
    }
}
