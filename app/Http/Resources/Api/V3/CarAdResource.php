<?php

namespace App\Http\Resources\Api\V3;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarAdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'is_active' => $this->status === 'published',
            'status' => $this->status,
            'is_premium' => isset($this->carAdType->expire_date) && now()->diffInSeconds($this->carAdType->expire_date, false) > 0,
            'user' => new UserResource($this->user),
            'car_brand' => new CarBrandResource($this->whenLoaded('carModel', $this->carModel->carBrand)),
            'car_model' => new CarModelResource($this->whenLoaded('carModel')),
            'year' => $this->year,
            'car_body' => new CarBodyResource($this->whenLoaded('carBody', $this->carBody, null)),
            'mileage' => $this->mileage,
            'motor' => $this->motor,
            'car_transmission' => new CarTransmissionResource($this->whenLoaded('carTransmission')),
            'car_type_of_drive' => new CarTypeOfDriveResource($this->whenLoaded('carTypeOfDrive')),
            'car_colour' => new CarColourResource($this->whenLoaded('carColour')),
            // 'vin_code' => $this->vin_code,
            'price' => $this->price,
            'car_place' => new CarPlaceResource($this->whenLoaded('carPlace')),
            'additional' => $this->description,
            'can_credit' => $this->can_credit,
            'can_exchange' => $this->can_exchange,
            'can_comment' => $this->can_comment,
            'slug' => $this->slug,
            'images' => MediaResource::collection($this->whenLoaded('media')),
            'phone' => $this->carAdPhones->first()->phone,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
