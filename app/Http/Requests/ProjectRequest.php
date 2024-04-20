<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape(['name' => "string"])]
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    #[ArrayShape(['name.required' => "string"])]
    public function messages(): array
    {
        return [
            'name.required' => 'The name is required.'
        ];
    }

}
