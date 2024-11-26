<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TariffUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'                 => 'required|string',
            'price'                => 'required|numeric',
            'delivery_time'        => 'nullable|string',
            'free_min_total_price' => 'required|numeric|min:0',
        ];
    }
}
