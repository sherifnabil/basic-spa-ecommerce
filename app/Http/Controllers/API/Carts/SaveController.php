<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Carts;

use App\Models\Cart;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CartRequest;

class SaveController extends Controller
{
    public function __invoke(CartRequest $request): Response
    {
        $data = $request->validated();

        $cart = Cart::query()->where([
            'user_id'    =>  $data['user_id'],
            'product_id' =>  $data['product_id'],
        ])
        ->first();
        // dd($data, $cart);

        if (is_null($cart)) {
            Cart::query()->create($data);
        } else {
            $cart->delete();
        }

        return new Response(
            content: null,
            status: Response::HTTP_CREATED
        );
    }
}
