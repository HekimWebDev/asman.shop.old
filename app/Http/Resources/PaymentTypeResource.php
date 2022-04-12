<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => [
                'tk' => $this->translate('tk')->name,
                'en' => $this->translate('en')->name,
                'ru' => $this->translate('ru')->name
            ],
            'slug' => $this->translate('en')->slug,
        ];
    }
}
