<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;

class PublicationCreateOrUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'value' => 'required|numeric|min:0',
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
