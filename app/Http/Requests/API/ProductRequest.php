<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'  =>  [
                'required',
                'string'
            ],

            'sku' =>  [
                'required',
                'string',
                'unique:products,sku,' . request('id')
            ],
            'image' =>  [
                'required',
                'image'
            ],
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = [
                'sometimes',
                'nullable',
                'image'
            ];
        }

        return $rules;
    }
}
