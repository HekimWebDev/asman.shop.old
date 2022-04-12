<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|array',
            'description' => 'required|array',
            'feature_1_title' => 'required|array',
            'feature_1_description' => 'required|array',
            'feature_2_title' => 'required|array',
            'feature_2_description' => 'required|array',
            'feature_3_title' => 'required|array',
            'feature_3_description' => 'required|array',
            'feature_4_title' => 'required|array',
            'feature_4_description' => 'required|array',
            'feature_5_title' => 'required|array',
            'feature_5_description' => 'required|array',
            'feature_6_title' => 'required|array',
            'feature_6_description' => 'required|array'
        ];
    }
}
