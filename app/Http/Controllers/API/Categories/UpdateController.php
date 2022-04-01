<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Categories;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\API\CategoryRequest;

class UpdateController extends Controller
{
    public function __invoke(CategoryRequest $request, $id): Response|JsonResponse
    {
        $data = $request->validated();

        $category = Category::query()->with(['products'])->find($id);

        if (! $category) {
            return new Response(
                content: 'Not Found Entity',
                status: Response::HTTP_NOT_FOUND
            );
        }

        $category->update($data);

        return new JsonResponse(
            data: new CategoryResource(
                resource: $category->refresh()
            ),
            status: Response::HTTP_ACCEPTED
        );
    }
}
