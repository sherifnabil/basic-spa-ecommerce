<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class ShowController extends Controller
{
    public function __invoke(Request $request, $id): Response|JsonResponse
    {
        $category = Category::query()->with(['products'])->find($id);

        if (! $category) {
            return new Response(
                content: 'Not Found Entity',
                status: Response::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(
            data: new CategoryResource(
                resource: $category
            ),
            status: Response::HTTP_ACCEPTED
        );
    }
}
