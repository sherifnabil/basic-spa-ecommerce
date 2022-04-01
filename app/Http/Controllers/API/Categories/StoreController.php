<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Categories;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\API\CategoryRequest;

class StoreController extends Controller
{
    public function __invoke(CategoryRequest $request)
    {
        $category = Category::query()->create($request->validated());

        return new JsonResponse(
            data: new CategoryResource(
                resource: $category->load('products')
            ),
            status: Response::HTTP_CREATED
        );
    }
}
