<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'full_name'             => 'required|string',
            'phone_number'          => 'required|string|digits:12|unique:users,phone_number',
            'password'              => 'required|string|min:6',
            'password_confirmation' => 'required|confirmed:password',
            'role'                  => 'required',
            'branch_id'             => 'nullable|exists:branches,id',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ];
    }
}
