<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'school_id'    => ['required', 'integer', 'exists:schools,id'],
            'branch_id'    => ['nullable', 'integer', 'exists:branches,id'],
            'version_id'   => ['nullable', 'integer', 'exists:versions,id'],
            'shift_id'     => ['nullable', 'integer', 'exists:shifts,id'],
            'active_status' => ['required', 'integer', 'in:0,1'],
            'created_by'   => ['nullable', 'integer', 'exists:users,id'],
            'updated_by'   => ['nullable', 'integer', 'exists:users,id'],
            'deleted_by'   => ['nullable', 'integer', 'exists:users,id'],
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

            'school_id.required'        => 'The school ID is required.',
            'school_id.exists'          => 'The selected school does not exist.',

            'branch_id.exists'          => 'The selected branch does not exist.',
            'version_id.exists'         => 'The selected version does not exist.',
            'shift_id.exists'           => 'The selected shift does not exist.',

            'active_status.required'    => 'The active status is required.',
            'active_status.in'          => 'The active status must be either Active (1) or Inactive (0).',

            'created_by.exists'         => 'The creator user does not exist.',
            'updated_by.exists'         => 'The updater user does not exist.',
            'deleted_by.exists'         => 'The deleter user does not exist.',
        ];
    }
}
