<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $products = Product::with('categories.brands')->get();

        return new JsonResponse(
            data: ProductResource::collection($products),
            status: Response::HTTP_OK,
        );
    }
}
