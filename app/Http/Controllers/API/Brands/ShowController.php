<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Brands;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\Category;

class ShowController extends Controller
{
    public function __invoke(Request $request, $id): Response|JsonResponse
    {
        $brand = Brand::query()->find($id);

        if (! $brand) {
            return new Response(
                content: 'Not Found Entity',
                status: Response::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(
            data: new BrandResource(
                resource: $brand
            ),
            status: Response::HTTP_ACCEPTED
        );
    }
}
