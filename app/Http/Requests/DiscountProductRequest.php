<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id'     => 'required',
            'discount_price' => 'nullable|numeric|min:0',
            'percentage'     => 'nullable|required_without:discount_price|numeric|min:0',
            'start_date'     => 'required',
            'end_date'       => 'required',
            'is_active'      => 'nullable|boolean',

        ];
    }

}
