<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'max:191',
                'required',
                'unique:departments,name,' . request()->route('department')->id,
            ],
            'manager_id'    => [
                'required'
            ],
        ];
    }
}
