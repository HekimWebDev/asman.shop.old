<?php

namespace App\Http\Controllers\Api\V3\CarAd\Brand;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Api\V3\CarBrandResource;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function index()
    {
        $carBrands = CarBrand::isActive()
            ->has('carModels')
            ->orderBy('name')
            ->get();

        return CarBrandResource::collection($carBrands);
    }
}
