<?php

namespace App\Http\Controllers\Api\V3\CarAd;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarColourResource;
use App\Models\CarColour;
use Illuminate\Http\Request;

class ColourController extends Controller
{
    public function index()
    {
        $carColours = CarColour::isActive()
            ->with([
                'translations'
            ])->get();

        return CarColourResource::collection($carColours);
    }
}