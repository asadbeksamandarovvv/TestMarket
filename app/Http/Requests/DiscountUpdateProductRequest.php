<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountUpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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
