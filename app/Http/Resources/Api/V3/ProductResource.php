<?php

namespace App\Http\Resources\Api\V3;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
                'tk' => $this->translate('tk')->name ?? null,
                'en' => $this->translate('en')->name ?? null,
                'ru' => $this->translate('ru')->name ?? null
            ],
            'description' => [
                'tk' => $this->translate('tk')->description ?? null,
                'en' => $this->translate('en')->description ?? null,
                'ru' => $this->translate('ru')->description ?? null
            ],
            'slug' => $this->translate('en')->slug,
            'link' => config('app.url') . '/products/' . $this->translate('en')->slug,
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->name,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => [
                    'tk' => $this->category->translate('tk')->name ?? null,
                    'en' => $this->category->translate('en')->name ?? null,
                    'ru' => $this->category->translate('ru')->name ?? null
                ],
            ],
            'images' => [
                'image' => $this->image ? asset('storage/original/' . $this->image) : '/defaultImage.png',
                'all_images' => $this->whenLoaded('images', $this->images->map(
                    fn($image) => asset('storage/original/' . $image->image)
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
