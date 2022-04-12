<?php

namespace App\Http\Resources\Api\V3;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'business_number' => $this->business_number,
            'working_time_start' => $this->working_time_start,
            'working_time_end' => $this->working_time_end,
            'business_address' => [
                'tk' => $this->business_address_tk,
                'en' => $this->business_address_en,
                'ru' => $this->business_address_ru,
            ],
            'about_us' => [
                'tk' => $this->about_us_tk,
                'en' => $this->about_us_en,
                'ru' => $this->about_us_ru,
            ]
        ];
    }
}
