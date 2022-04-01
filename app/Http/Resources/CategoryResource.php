<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
                'brands' =>  BrandResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'brands'
                    )
                )
            ],
        ];
    }
}
