<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\ProductResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::with('children')->find($request->get('category_id'));
        $categoryIds = collect();
        if ($category) {
            $categoryIds = $category->getAllChildren()->pluck('id');
        }
        $categoryIds->prepend((int)$request->get('category_id'));
        $products = Product::inStock()
            ->when(
                $request->filled('attribute_value_ids'),
                fn($query) => $query->whereHas(
                    'attributeValues',
                    fn($query) => $query->whereIn('attribute_value_id', $request->get('attribute_value_ids'))
                )
            )
            ->when(
                $request->filled('q'),
                fn($query) => $query->whereTranslationLike('name', '%' . $request->get('q') . '%', $request->get('lang'))
            )
            // ->when(
            //     $request->boolean('discount'),
            //     fn ($query) => $query->whereNotNUll('discount_price')
            // )
            ->when(
                $request->boolean('hit'),
                fn($query) => $query->where('hit', $request->boolean('hit'))
            )
            ->when(
                $request->filled('brands'),
                fn($query) => $query->whereIn('brand_id', explode(',', $request->get('brands')))
            )
            ->when(
                $request->filled('category_id'),
                fn($query) => $query->whereHas(
                    'category',
                    fn($query) => $query->whereIn('id', $categoryIds)
                )
            )
            ->when(
                $request->filled(['min_price', 'max_price']),
                fn($query) => $query->whereBetween('price', [$request->get('min_price'), $request->get('max_price')])
                    ->orWhereBetween('discount_price', [$request->get('min_price'), $request->get('max_price')])
            )
            ->when(
                $request->filled('price'),
                fn($query) => $query->orderBy('price', $request->get('price'))
            )
            ->when(
                $request->filled('name'),
                fn($query) => $query->orderByTranslation('name', $request->get('name'))
            )
            ->when(
                $request->filled('date'),
                fn($query) => $query->orderBy('created_at', $request->get('date'))
            )
            ->skip($request->get('offset'))
            ->take($request->get('limit', PHP_INT_MAX))
            ->with('brand')
            ->get();

        $brands = $products->map(
            fn($product) => $product->brand
        )->unique('id')->filter(
            fn($brand) => $brand->id
        );

        return ProductResource::collection($products)->additional([
            'min_price' => $products->min('discount_price') ?? $products->min('price'),
            'max_price' => $products->max('price'),
            'result' => $products->count(),
            'children' => $category ? CategoryResource::collection($category->children) : null,
            'brands' => BrandResource::collection($brands)
        ]);
    }

    public function show(Request $request)
    {
        $product = Product::with([
            'translation',
            'category.products' => fn($query) => $query->inStock(),
            'category.products.brand',
            'images',
            'brand'
        ])->findOrFail($request->id);

        $similarProducts = $product->category->products->reject(
            fn($value) => $value->id === $product->id
        )->take(9)->loadMissing('images');

        $similarBrands = $product->category->products->map(
            fn($product) => $product->brand
        )->filter()->unique('name');

        return response()->json([
            'product' => new ProductResource($product),
            'similar_products' => ProductResource::collection($similarProducts),
            'similar_brands' => $similarBrands,
        ]);
    }
}
