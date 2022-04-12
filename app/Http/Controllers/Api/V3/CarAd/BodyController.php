<?php

namespace App\Http\Controllers\Api\V3\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarBodyResource;
use App\Models\CarBody;
use Illuminate\Http\Request;

class BodyController extends Controller
{
    public function index()
    {
        $carBodies = CarBody::isActive()
            ->with([
                'translations'
            ])->get();

        return CarBodyResource::collection($carBodies);
    }
}