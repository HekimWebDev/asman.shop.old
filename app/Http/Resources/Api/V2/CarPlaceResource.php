<?php

namespace App\Http\Resources\Api\V2;

use Illuminate\Http\Resources\Json\JsonResource;

class CarPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => [
                'tk' => 'Ýerleşýän ýeri',
                'en' => 'Location',
                'ru' => 'Место нахождения'
            ],
            'value' => [
                'tk' => $this->translate('tk')->name  ?? null,
                'en' => $this->translate('en')->name  ?? null,
                'ru' => $this->translate('ru')->name  ?? null
            ],
            'has_children' => $this->children()->exists()
        ];
    }
}
