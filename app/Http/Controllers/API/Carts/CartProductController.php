<?php

namespace App\Http\Controllers\API\Carts;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Cart;

class CartProductController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $carts = Cart::where(
            'user_id',
            auth()->id()
        )
        ->with(['product.categories.brands'])
        ->get();

        return new JsonResponse(
            data: ProductResource::collection($carts->pluck('product')),
            status: Response::HTTP_OK,
        );
    }
}
