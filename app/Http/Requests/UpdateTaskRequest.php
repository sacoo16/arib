<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }

    public function rules(): array
    {
        return [
            'title'             => [
                'string',
                'required',
                'max:255',
            ],
            'description'     => [
                'string',
                'required'
            ],
            // 'assigned_to_id'  => [
            //     'required'
            // ],
        ];
    }
}
