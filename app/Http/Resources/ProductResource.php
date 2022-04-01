<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    =>  $this->id,
            'type'  =>  'product',
            'attributes'  =>  [
                'name' =>  $this->name,
                'sku' =>  $this->sku,
                'in_cart' =>  $this->in_cart,
                'image'=>  asset('storage/' . $this->image),
            ],
            'relations'    =>  [
                'categories' =>  CategoryResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'categories'
                    )
                )
            ],
        ];
    }
}
