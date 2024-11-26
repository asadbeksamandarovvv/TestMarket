<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

class ProductUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => [
                'required',
                'string',
                'max:255',
            ],
            'name_ru'        => "nullable|string",
            'description'    => ['nullable', 'string'],
            'description_ru' => ['nullable', 'string'],
            'price'          => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'selling_price'  => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'quantity'       => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'image'          => 'nullable|file',
            'category_id'    => 'required',
            'parent_id'      => 'nullable',
            'brand_id'       => 'required',
            'is_active'      => 'nullable|boolean',


        ];
    }
}
