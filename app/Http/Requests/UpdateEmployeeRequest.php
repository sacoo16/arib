<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }

    public function rules(): array
    {
        return [
            'first_name'        => [
                'string',
                'max:255',
                'required',
            ],
            'last_name'        => [
                'string',
                'max:255',
                'required',
            ],
            'phone'        => [
                'string',
                'min:11',
                'max:11',
                'required',
                'unique:users,phone,' . request()->route('employee')->user_id,
            ],
            'email'        => [
                'required',
                'unique:users,email,' . request()->route('employee')->user_id,
            ],
        ];
    }
}
