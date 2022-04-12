<?php

namespace App\Http\Resources\Api\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
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
            'id' => $this->id,
            'name' => [
                'tk' => $this->translate('tk')->name ?? null,
                'en' => $this->translate('en')->name ?? null,
                'ru' => $this->translate('ru')->name ?? null
            ],
            'attribute_values' => AttributeValueResource::collection($this->attributeValues)
        ];
    }
}
