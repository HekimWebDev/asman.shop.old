<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceCategoryResource extends JsonResource
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
            'icon' => $this->when($this->icon, asset('storage/' . $this->icon), '/defaultImage.png'),
            'image' => $this->image
                ? (filter_var($this->image, FILTER_VALIDATE_URL)
                    ? $this->image
                    : asset('storage/original/' . $this->image))
                : '/defaultImage.png',
            'services_count' => $this->when(isset($this->services_count), $this->services_count, 0),
            'services' => ServiceResource::collection($this->whenLoaded('services'))
        ];
    }
}
