<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProductsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'cart',
            'relations'    =>  [
                'product' =>  new ProductResource(
                    resource: $this->whenLoaded(
                        relationship: 'product'
                    )
                )
            ],

        ];
    }
}
