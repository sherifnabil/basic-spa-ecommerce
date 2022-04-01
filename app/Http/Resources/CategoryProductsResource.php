<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'category',
            'attributes'    =>  [
                'name' =>  $this->name
            ],
            'relations'    =>  [
                'products' =>  ProductResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'products'
                    )
                )
            ],

        ];
    }
}
