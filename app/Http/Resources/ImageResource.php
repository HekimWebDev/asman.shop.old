<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    private $image;

    public function __construct($image)
    {
        $this->image = $image;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'original' => asset('storage/original/' . $this->image),
            'large' => asset('storage/large/' . $this->image),
            'medium' => asset('storage/medium/' . $this->image),
            'mobile' => asset('storage/mobile/' . $this->image),
            'tiny' => asset('storage/tiny/' . $this->image),
        ];
    }
}
