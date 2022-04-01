<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Brands;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $brands = Brand::all();

        return new JsonResponse(
            data: BrandResource::collection($brands),
            status: Response::HTTP_OK,
        );
    }
}
