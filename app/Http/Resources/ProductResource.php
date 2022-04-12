<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => [
                'tk' => $this->translate('tk')->description,
                'en' => $this->translate('en')->description,
                'ru' => $this->translate('ru')->description
            ],
            'slug' => $this->translate('en')->slug,
            'category' => [
                'name' => [
                    'tk' => $this->category->translate('tk')->name,
                    'en' => $this->category->translate('en')->name,
                    'ru' => $this->category->translate('ru')->name
                ]
            ],
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'images' => [
                'image' => $this->image ? asset('storage/original/' . $this->image) : '/defaultImage.png',
                'all_images' => $this->whenLoaded('images', $this->images->map(
                    fn ($image) => asset('storage/original/' . $image->image)
                ))
            ],
            'price' => $this->price ?? '0.00',
            'discount_price' => $this->discount_price,
            'quantity' => $this->quantity,
            'hit' => $this->hit,
            'created_at' => $this->created_at
        ];
    }
}
