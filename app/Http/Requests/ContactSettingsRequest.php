<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactSettingsRequest extends FormRequest
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
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'business_number' => 'required|string',
            'working_time_start' => 'required|date_format:H:i',
            'working_time_end' => 'required|date_format:H:i|after:working_time_start',
            'business_address_tk' => 'required|string',
            'business_address_en' => 'required|string',
            'business_address_ru' => 'required|string',
            'about_us_tk' => 'required|string',
            'about_us_en' => 'required|string',
            'about_us_ru' => 'required|string'
        ];
    }
}
