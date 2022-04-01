<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Products;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\API\ProductRequest;

class StoreController extends Controller
{
    public function __invoke(ProductRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')->storeAs(
            path:    'products',
            name:    time() .'.' . $request->file('image')->getClientOriginalExtension(),
            options: ['disk' => 'public']
        );

        $product = Product::query()->create($data);

        return new JsonResponse(
            data: new ProductResource(
                resource: $product->load('categories')
            ),
            status: Response::HTTP_CREATED
        );
    }
}
