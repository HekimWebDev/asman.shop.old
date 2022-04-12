<?php

namespace App\Http\Controllers\Api\V2\CarAd\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\CarModelResource;
use App\Models\CarModel;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     */
    public function index(Request $request, $id)
    {
        $carModels = CarModel::whereHas(
            'CarBrand',
            fn($query) => $query->where('id', $id)->isActive()
        )->isActive()->orderBy('name');

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $carModels = $carModels->paginate($per_page);

            return CarModelResource::collection($carModels)->appends($request->query());
        } else {
            $carModels = $carModels->get();
        }

        return CarModelResource::collection($carModels);
    }
}
