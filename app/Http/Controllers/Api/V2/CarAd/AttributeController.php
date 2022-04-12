<?php

namespace App\Http\Controllers\Api\V2\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\CarBodyResource;
use App\Http\Resources\Api\V2\CarColourResource;
use App\Http\Resources\Api\V2\CarTransmissionResource;
use App\Http\Resources\Api\V2\CarTypeOfDriveResource;
use App\Models\CarBody;
use App\Models\CarColour;
use App\Models\CarTransmission;
use App\Models\CarTypeOfDrive;

class AttributeController extends Controller
{
    function index()
    {
        $carBodies = CarBody::isActive()->with(['translations'])->get();
        $carColours = CarColour::isActive()->with(['translations'])->get();
        $carTransmissions = CarTransmission::isActive()->with(['translations'])->get();
        $carTypeOfDrives = CarTypeOfDrive::isActive()->with(['translations'])->get();

        return response([
            'attributes' => [
                [
                    'id' => 1,
                    'key' => 'body',
                    'name' => [
                        'tk' => 'Kuzow',
                        'en' => 'Body',
                        'ru' => 'Кузов',
                    ],
                    'options' => CarBodyResource::collection($carBodies)
                ],
                [
                    'id' => 2,
                    'key' => 'color',
                    'name' => [
                        'tk' => 'Reňk',
                        'en' => 'Color',
                        'ru' => 'Цвет',
                    ],
                    'options' => CarColourResource::collection($carColours)
                ],
                [
                    'id' => 3,
                    'key' => 'transmission',
                    'name' => [
                        'tk' => 'Geçiriş',
                        'en' => 'Transmission',
                        'ru' => 'Трансмиссия',
                    ],
                    'options' => CarTransmissionResource::collection($carTransmissions)
                ],
                [
                    'id' => 4,
                    'key' => 'type_of_drive',
                    'name' => [
                        'tk' => 'Sürüjiniň görnüşi',
                        'en' => 'Type of drive',
                        'ru' => 'Тип привода',
                    ],
                    'options' => CarTypeOfDriveResource::collection($carTypeOfDrives)
                ]
            ]
        ]);
    }
}
