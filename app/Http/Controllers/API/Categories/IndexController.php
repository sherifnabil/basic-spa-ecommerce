<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $category = Category::with('products')->get();

        return new JsonResponse(
            data: CategoryResource::collection($category),
            status: Response::HTTP_OK,
        );
    }
}
