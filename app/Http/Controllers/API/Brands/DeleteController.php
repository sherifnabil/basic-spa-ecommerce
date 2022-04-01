<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Brands;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke(Request $request, $id): Response
    {
        $brand = Brand::query()->find($id);

        if (! $brand) {
            return new Response(
                content: 'Not Found Entity',
                status: Response::HTTP_NOT_FOUND
            );
        }

        $brand->delete();

        return new Response(
            content: null,
            status: Response::HTTP_ACCEPTED
        );
    }
}
