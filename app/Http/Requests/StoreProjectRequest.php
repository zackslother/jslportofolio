<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul_project' => ['required', 'string', 'max:255'],
            'deskripsi_project' => ['required', 'string'],
            'image_project' => ['nullable', 'image', 'max:2048'],
            'project_price' => ['required', 'numeric', 'min:0'],
        ];
    }
}