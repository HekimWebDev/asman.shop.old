<?php

namespace App\Http\Resources\Api\V3;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class CarPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "mixed", 'name' => "array", 'has_children' => "mixed"])] public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'tk' => $this->translate('tk')->name ?? null,
                'en' => $this->translate('en')->name ?? null,
                'ru' => $this->translate('ru')->name ?? null
            ],
            'has_children' => $this->children()->exists()
        ];
    }
}
