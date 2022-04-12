<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'service-category' => new ServiceCategoryResource($this->whenLoaded('serviceCategory')),
            'name' => [
                'tk' => $this->translate('tk')->name,
                'en' => $this->translate('en')->name,
                'ru' => $this->translate('ru')->name
            ],
            'description' => [
                'tk' => $this->translate('tk')->description,
                'en' => $this->translate('en')->description,
                'ru' => $this->translate('ru')->description
            ],
            'owner' => [
                'tk' => $this->translate('tk')->owner,
                'en' => $this->translate('en')->owner,
                'ru' => $this->translate('ru')->owner
            ],
            'address' => [
                'tk' => $this->translate('tk')->address,
                'en' => $this->translate('en')->address,
                'ru' => $this->translate('ru')->address
            ],

            'phone' => '+993 ' . $this->phone,
            'email' => $this->email,
            'slug' => $this->translate('en')->slug,
            'image' => $this->image
                ? (filter_var($this->image, FILTER_VALIDATE_URL)
                    ? $this->image
                    : asset('storage/original/' . $this->image))
                : '/defaultImage.png',
        ];
    }
}
