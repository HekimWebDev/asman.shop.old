<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image' => $this->when($this->image, asset('storage/original/' . $this->image), '/defaultImage.png'),
            'is_main' => $this->is_main,
            'products_count' => $this->when(isset($this->products_count), $this->products_count, 0),
            // 'total_products_count' => $this->when(isset($this->total_products_count), $this->total_products_count, 0),
            'childs' => CategoryResource::collection($this->whenLoaded('childs')),
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
