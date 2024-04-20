<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\ArrayShape;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['name' => "string", 'project_id' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'project_id' => 'required|integer|exists:projects,id'
        ];
    }

    #[ArrayShape([
        'name.required' => "string",
        'project_id.required' => "string",
        'project_id.integer' => "string",
        'project_id.exists' => "string"
    ])]
    public function messages(): array
    {
        return [
            'name.required' => 'The task name is required.',
            'project_id.required' => 'The project is required.',
            'project_id.integer' => 'The project ID must be a valid integer.',
            'project_id.exists' => 'The selected project does not exist.',
        ];
    }

}
