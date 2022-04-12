<?php

namespace App\Http\Controllers\Api\V2\CarAd\Brand;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Api\V2\CarBrandResource;
use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class Controller extends BaseController
{
    /**
     * @param Request $request
     */
    function index(Request $request)
    {
        $carBrands = CarBrand::isActive()->has('carModels')->orderBy('name');

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $carBrands = $carBrands->paginate($per_page);

            return CarBrandResource::collection($carBrands)->appends($request->query());
        } else {
            $carBrands = $carBrands->get();
        }

        return CarBrandResource::collection($carBrands);
    }
}
