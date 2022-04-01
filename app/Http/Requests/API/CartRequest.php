<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' =>  [
                'required',
                'exists:products,id'
            ],
            'user_id' =>  [
                'required',
                'exists:users,id'
            ],
        ];
    }
}
