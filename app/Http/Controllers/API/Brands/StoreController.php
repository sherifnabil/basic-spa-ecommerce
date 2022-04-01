<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Brands;

use App\Models\Brand;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Requests\API\BrandRequest;

class StoreController extends Controller
{
    public function __invoke(BrandRequest $request)
    {
        $brand = Brand::query()->create($request->validated());

        return new JsonResponse(
            data: new BrandResource(
                resource: $brand
            ),
            status: Response::HTTP_CREATED
        );
    }
}
