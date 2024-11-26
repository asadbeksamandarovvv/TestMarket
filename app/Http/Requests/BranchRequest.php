<?php

namespace App\Http\Requests;

use App\Models\Branch;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'    => 'required|string',
            'address' => 'nullable|string',
        ];
    }
}
