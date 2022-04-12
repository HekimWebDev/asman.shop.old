<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
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
            'slug' => $this->translate('en')->slug,
            'category' => [
                'name' => [
                    'tk' => $this->blogCategory->translate('tk')->name,
                    'en' => $this->blogCategory->translate('en')->name,
                    'ru' => $this->blogCategory->translate('ru')->name
                ]
            ],
            'image' => $this->image
                ? (filter_var($this->image, FILTER_VALIDATE_URL)
                    ? $this->image
                    : asset('storage/original/' . $this->image))
                : '/defaultImage.png'
        ];
    }
}
