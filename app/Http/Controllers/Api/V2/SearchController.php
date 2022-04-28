<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\ProductResource;
use App\Http\Resources\BrandResource;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->search;

        $products = Product::inStock()
            ->whereTranslationLike('name', '%' . $q . '%');

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $products = $products->paginate($per_page);

            return ProductResource::collection($products)->appends($request->query());
        } else {
            $products = $products->get();
        }

        return ProductResource::collection($products);
    }

    public function attributes(Request $request)
    {
        $q = $request->search;

        $products = Product::inStock()
            ->whereTranslationLike('name', '%' . $q . '%')
            ->with('brand')
            ->get();

        $brands = $products->map(
            fn ($product) => $product->brand
        )->unique('id')->filter(
            fn ($brand) => $brand->id
        );

        return [
            'min_price' => $products->min('discount_price') ?? $products->min('price'),
            'max_price' => $products->max('price'),
            'brands' => BrandResource::collection($brands)
        ];
    }
}
