<?php

namespace App\Http\Controllers\Api\V3\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarTransmissionResource;
use App\Models\CarTransmission;
use Illuminate\Http\Request;

class TransmissionController extends Controller
{
    public function index()
    {
        $carTransmissions = CarTransmission::isActive()
            ->with([
                'translations'
            ])->get();

        return CarTransmissionResource::collection($carTransmissions);
    }
}
