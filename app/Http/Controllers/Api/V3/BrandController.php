<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::active()
            ->when(
                $request->q,
                fn ($query) => $query->where('name', 'LIKE', '%' . $request->q . '%')
            )
            ->when(
                $request->offset,
                fn ($query) => $query->skip($request->offset)
            )
            ->when(
                $request->limit,
                fn ($query) => $query->take($request->limit)
            )
            ->whereHas(
                'products',
                fn ($query) => $query->inStock()
            )
            ->inRandomOrder()
            ->get();

        return BrandResource::collection($brands)->additional([
            'result' => $brands->count()
        ]);
    }
}