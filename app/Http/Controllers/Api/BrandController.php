<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = QueryBuilder::for(Brand::class)
            ->allowedSorts('created_at')
            ->active()
            ->take($request->limit)
            ->has('products')
            ->get();

        return response()->json(BrandResource::collection($brands));
    }

    public function products(Brand $brand)
    {
        $brand = $brand->loadMissing([
            'products' => fn ($query) => $query->inStock()
        ]);
        return response(new BrandResource($brand));
    }

    public function categories(Brand $brand)
    {
        $categories = $brand->products->map(
            fn ($product) => $product->category
        )->filter()->unique('name');

        return response(CategoryResource::collection($categories));
    }
}