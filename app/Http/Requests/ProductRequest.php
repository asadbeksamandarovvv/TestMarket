<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'name_ru'        => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'description_ru' => 'required|string|max:255',
            'price'          => 'nullable|numeric|min:0',
            'selling_price'  => 'nullable|numeric|min:0',
            'category_id'    => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'quantity'       => 'nullable|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active'      => 'nullable|boolean',
        ];
    }
}
