<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
                'tk' => $this->product->translate('tk')->name,
                'en' => $this->product->translate('en')->name,
                'ru' => $this->product->translate('ru')->name
            ],
            'image' => $this->product->image ? asset('storage/original/' . $this->image) : '/defaultImage.png',
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
