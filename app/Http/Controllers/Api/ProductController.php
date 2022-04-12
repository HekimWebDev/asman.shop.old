<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\QueryBuilder\Sorts\TranslationSort;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = QueryBuilder::for(Product::class)
            ->translatedIn($request->lang)
            ->allowedIncludes('translation')
            ->allowedSorts(
                AllowedSort::custom('name', new TranslationSort(), 'name'),
                'created_at',
                'price',
            )
            ->allowedFilters([
                'id',
                AllowedFilter::scope('slug', 'whereSlug'),
                'hit'
            ])
            ->inStock()
            ->with([
                'translation',
                'images',
                'brand'
            ])
            ->take($request->limit)
            ->get();

        return response()->json(ProductResource::collection($products));
    }

    public function show(Request $request)
    {
        $product = Product::whereTranslation('slug', $request->slug)
            ->with([
                'translation',
                'category.products' => fn ($query) => $query->inStock(),
                'category.products.brand',
                'images',
                'brand'
            ])->firstOrFail();

        $similarProducts = $product->category->products->reject(
            fn ($value) => $value->id === $product->id
        )->take(9)->loadMissing('images');

        $similarBrands = $product->category->products->map(
            fn ($product) => $product->brand
        )->filter()->unique('name');

        return response()->json([
            'product' => new ProductResource($product),
            'similar_products' => ProductResource::collection($similarProducts),
            'similar_brands' => $similarBrands,
        ]);
    }

    public function attributes(Request $request)
    {
        $product = Product::whereTranslation('slug', $request->slug)
            ->with([
                'attributeValues'
            ])->firstOrFail();

        return response(AttributeResource::collection($product->attributeValues));
    }
}
