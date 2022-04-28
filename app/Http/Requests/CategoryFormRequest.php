<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => $this->isMethod('POST') ? ['required'] : ['nullable'] ,
            'status' => ['boolean'],

            'name:tk' => ['nullable', 'min:2', 'max:35', 'string'],
            'name:en' => ['nullable', 'min:2', 'max:35', 'string'],
            'name:ru' => ['nullable', 'min:2', 'max:35', 'string'],

            'description:tk' => ['nullable', 'min:3', 'string'],
            'description:en' => ['nullable', 'min:3', 'string'],
            'description:ru' => ['nullable', 'min:3', 'string'],

            'image' => ['required', 'mimes:png,jpg,webp'],
//                'status' => 'boolean',
//                'banner' => 'nullable|mimes:png,jpg,webp'
        ];
    }
}
