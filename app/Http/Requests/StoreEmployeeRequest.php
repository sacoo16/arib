<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
                'unique:users,phone',
            ],
            'email'        => [
                'required',
                'unique:users,email',
            ],
        ];
    }
}
