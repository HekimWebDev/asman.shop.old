<?php

namespace App\Http\Resources\Api\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsSettingResource extends JsonResource
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
            'title' => [
                'tk' => $this->title['tk'],
                'en' => $this->title['en'],
                'ru' => $this->title['ru'],
            ],
            'description' => [
                'tk' => $this->description['tk'],
                'en' => $this->description['en'],
                'ru' => $this->description['ru'],
            ],
            'features' => [
                [
                    'title' => [
                        'tk' => $this->feature_1_title['tk'],
                        'en' => $this->feature_1_title['en'],
                        'ru' => $this->feature_1_title['ru'],
                    ],
                    'description' => [
                        'tk' => $this->feature_1_description['tk'],
                        'en' => $this->feature_1_description['en'],
                        'ru' => $this->feature_1_description['ru'],
                    ],
                ],
                [
                    'title' => [
                        'tk' => $this->feature_2_title['tk'],
                        'en' => $this->feature_2_title['en'],
                        'ru' => $this->feature_2_title['ru'],
                    ],
                    'description' => [
                        'tk' => $this->feature_2_description['tk'],
                        'en' => $this->feature_2_description['en'],
                        'ru' => $this->feature_2_description['ru'],
                    ],
                ],
                [
                    'title' => [
                        'tk' => $this->feature_3_title['tk'],
                        'en' => $this->feature_3_title['en'],
                        'ru' => $this->feature_3_title['ru'],
                    ],
                    'description' => [
                        'tk' => $this->feature_3_description['tk'],
                        'en' => $this->feature_3_description['en'],
                        'ru' => $this->feature_3_description['ru'],
                    ],
                ],
                [
                    'title' => [
                        'tk' => $this->feature_4_title['tk'],
                        'en' => $this->feature_4_title['en'],
                        'ru' => $this->feature_4_title['ru'],
                    ],
                    'description' => [
                        'tk' => $this->feature_4_description['tk'],
                        'en' => $this->feature_4_description['en'],
                        'ru' => $this->feature_4_description['ru'],
                    ],
                ],
                [
                    'title' => [
                        'tk' => $this->feature_5_title['tk'],
                        'en' => $this->feature_5_title['en'],
                        'ru' => $this->feature_5_title['ru'],
                    ],
                    'description' => [
                        'tk' => $this->feature_5_description['tk'],
                        'en' => $this->feature_5_description['en'],
                        'ru' => $this->feature_5_description['ru'],
                    ],
                ],
                [
                    'title' => [
                        'tk' => $this->feature_6_title['tk'],
                        'en' => $this->feature_6_title['en'],
                        'ru' => $this->feature_6_title['ru'],
                    ],
                    'description' => [
                        'tk' => $this->feature_6_description['tk'],
                        'en' => $this->feature_6_description['en'],
                        'ru' => $this->feature_6_description['ru'],
                    ],
                ]
            ],
        ];
    }
}
