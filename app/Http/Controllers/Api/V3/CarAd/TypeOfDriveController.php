<?php

namespace App\Http\Controllers\Api\V3\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarTypeOfDriveResource;
use App\Models\CarTypeOfDrive;
use Illuminate\Http\Request;

class TypeOfDriveController extends Controller
{
    public function index()
    {
        $carTypeOfDrives = CarTypeOfDrive::isActive()
            ->with([
                'translations'
            ])->get();

        return CarTypeOfDriveResource::collection($carTypeOfDrives);
    }
}
