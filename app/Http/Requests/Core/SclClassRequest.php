<?php

namespace App\Http\Requests\Core;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SclClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:200', 'regex:/^[A-Za-z0-9\s\-]+$/'],
            'class_code'   => ['nullable', 'string', 'max:50', 'regex:/^[A-Za-z0-9]+$/'],
            'active_status' => ['required', 'integer', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'The class name is required.',
            'name.max'                  => 'The class name cannot exceed 200 characters.',
            'name.regex'                => 'The class name can only contain letters, numbers, spaces, and dashes.',

            'class_code.max'            => 'The class code cannot exceed 50 characters.',
            'class_code.regex'          => 'The class code can only contain letters and numbers.',

            'active_status.required'    => 'The active status is required.',
            'active_status.in'          => 'The active status must be either Active (1) or Inactive (0).',
        ];
    }
}
