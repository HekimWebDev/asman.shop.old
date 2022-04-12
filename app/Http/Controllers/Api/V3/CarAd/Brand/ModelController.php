<?php

namespace App\Http\Controllers\Api\V3\CarAd\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\CarModelResource;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index($id)
    {
        $carModels = CarBrand::with([
            'carModels' => fn ($query) => $query->isActive()->orderBy('name')
        ])->find($id)->carModels;

        return CarModelResource::collection($carModels);
    }
}
