<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'image' => [
                'tk' => asset('storage/original/' . $this->translate('tk')->image),
                'en' => asset('storage/original/' . $this->translate('en')->image),
                'ru' => asset('storage/original/' . $this->translate('ru')->image),
            ],
            'link' => $this->link ?? '#',
        ];
    }
}
