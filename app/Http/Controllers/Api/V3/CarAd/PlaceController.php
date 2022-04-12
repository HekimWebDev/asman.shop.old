<?php

namespace App\Http\Controllers\Api\V3\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarPlaceResource;
use App\Models\CarPlace;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $carPlaces = CarPlace::isActive()
            ->whereIsRoot()
            ->with([
                'translations'
            ])->get();

        return CarPlaceResource::collection($carPlaces);
    }

    public function children($id)
    {
        $carPlace = CarPlace::isActive()->with([
            'children' => fn ($query) => $query->isActive()->with([
                'translations'
            ])
        ])->findOrFail($id);

        if ($carPlace->isRoot() && $carPlace->children->isEmpty()) {
            return new CarPlaceResource($carPlace);
        }

        return CarPlaceResource::collection($carPlace->children);
    }
}