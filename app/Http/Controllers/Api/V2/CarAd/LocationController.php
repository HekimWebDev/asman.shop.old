<?php

namespace App\Http\Controllers\Api\V2\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\CarLocationResource;
use App\Models\CarPlace;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    function index(): AnonymousResourceCollection
    {
        $carPlaces = CarPlace::isActive()
            ->whereIsRoot()
            ->with([
                'translations',
                'children'
            ])->get();

        return CarLocationResource::collection($carPlaces);
    }
}
