<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'price'         => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ];
    }
}
