<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Brands;

use App\Models\Brand;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\BrandRequest;
use App\Http\Resources\BrandResource;

class UpdateController extends Controller
{
    public function __invoke(BrandRequest $request, $id): Response|JsonResponse
    {
        $data = $request->validated();

        $brand = Brand::query()->find($id);

        if (! $brand) {
            return new Response(
                content: 'Not Found Entity',
                status: Response::HTTP_NOT_FOUND
            );
        }

        $brand->update($data);

        return new JsonResponse(
            data: new BrandResource(
                resource: $brand->refresh()
            ),
            status: Response::HTTP_ACCEPTED
        );
    }
}
