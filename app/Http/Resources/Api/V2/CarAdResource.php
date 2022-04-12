<?php

namespace App\Http\Resources\Api\V2;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarAdResource extends JsonResource
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
            'is_active' => $this->status === 'published',
            'status' => $this->status,
            'is_premium' => isset($this->carAdType->expire_date) && now()->diffInSeconds($this->carAdType->expire_date, false) > 0,
            'phone' => $this->carAdPhones->first()->phone,
            'price' => $this->price,
            'car_brand' => new CarBrandResource($this->carModel->carBrand),
            'car_model' => new CarModelResource($this->carModel),
            'year' => $this->year,
            'user' => new UserResource($this->user),
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'slug' => $this->slug,
            'images' => MediaResource::collection($this->getMedia()->sortBy('order_column')),
            'can_comment' => $this->can_comment,
            'characteristics' => [
                'body' => new CarBodyResource($this->carBody),
                'mileage' => [
                    'name' => [
                        'tk' => 'Geçen ýoly',
                        'en' => 'Mileage',
                        'ru' => 'Пробег'
                    ],
                    'value' => [
                        'tk' => $this->mileage,
                        'en' => $this->mileage,
                        'ru' => $this->mileage
                    ]
                ],
                'motor' => [
                    'name' => [
                        'tk' => 'Motor',
                        'en' => 'Motor',
                        'ru' => 'Мотор'
                    ],
                    'value' => [
                        'tk' => $this->motor,
                        'en' => $this->motor,
                        'ru' => $this->motor
                    ]
                ],
                'transmission' => new CarTransmissionResource($this->carTransmission),
                'type_of_drive' => new CarTypeOfDriveResource($this->carTypeOfDrive),
                'color' => new CarColourResource($this->carColour),
                'location' => new CarPlaceResource($this->carPlace),
                'additional' => [
                    'name' => [
                        'tk' => 'Goşmaça',
                        'en' => 'Additional',
                        'ru' => 'Дополнительный'
                    ],
                    'value' => [
                        'tk' => $this->description,
                        'en' => $this->description,
                        'ru' => $this->description
                    ]
                ],
                'can_credit' => [
                    'name' => [
                        'tk' => 'Karz berip biler',
                        'en' => 'Can credit',
                        'ru' => 'Может кредит'
                    ],
                    'value' => [
                        'tk' => $this->can_credit ? 'Hawa' : 'Ýok',
                        'en' => $this->can_credit ? 'Yes' : 'No',
                        'ru' => $this->can_credit ? 'Да' : 'Нет'
                    ],
                    'payload' => $this->can_credit
                ],
                'can_exchange' => [
                    'name' => [
                        'tk' => 'Karz berip biler',
                        'en' => 'Can credit',
                        'ru' => 'Может кредит'
                    ],
                    'value' => [
                        'tk' => $this->can_exchange ? 'Hawa' : 'Ýok',
                        'en' => $this->can_exchange ? 'Yes' : 'No',
                        'ru' => $this->can_exchange ? 'Да' : 'Нет'
                    ],
                    'payload' => $this->can_exchange
                ]
            ]
        ];
    }
}
