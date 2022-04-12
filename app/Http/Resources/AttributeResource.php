<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'attribute_id' => $this->attribute->id,
            'attribute_name' => [
                'tk' => $this->attribute->translate('tk')->name,
                'en' => $this->attribute->translate('en')->name,
                'ru' => $this->attribute->translate('ru')->name
            ],
            'attribute_value_id' => $this->id,
            'attribute_value' => [
                'tk' => $this->translate('tk')->name,
                'en' => $this->translate('en')->name,
                'ru' => $this->translate('ru')->name
            ],
        ];
    }
}
