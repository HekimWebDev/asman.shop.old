<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\ProductResource;
use App\Http\Resources\AttributeResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::with('children')->find($request->get('category'));
        $categoryIds = collect();
        if ($category) {
            $categoryIds = $category->getAllChildren()->pluck('id');
        }
        $categoryIds->prepend((int)$request->get('category'));

        $products = Product::inStock()
            ->when(
                $request->filled('attribute_value_ids'),
                fn($query) => $query->whereHas(
                    'attributeValues',
                    fn($query) => $query->whereIn('attribute_value_id', $request->get('attribute_value_ids'))
                )
            )
            ->when(
                $request->has('q'),
                fn($query) => $query->whereTranslationLike('name', '%' . $request->q . '%', $request->lang)
            )
            ->when(
                $request->boolean('discount'),
                fn($query) => $query->whereNotNUll('discount_price')
            )
            ->when(
                $request->has('brand'),
                fn($query) => $query->whereIn('brand_id', explode(',', $request->get('brand')))
            )
            ->when(
                $request->has('category'),
                fn($query) => $query->whereHas(
                    'category',
                    fn($query) => $query->whereIn('id', $categoryIds)
                )
            )
            ->when(
                $request->has(['min_price', 'max_price']),
                fn($query) => $query->whereBetween('price', [$request->min_price, $request->max_price])
                    ->orWhereBetween('discount_price', [$request->min_price, $request->max_price])
            )
            ->when(
                $request->has('price'),
                fn($query) => $query->orderBy('price', $request->get('price'))
            )
            ->when(
                $request->has('name'),
                fn($query) => $query->orderByTranslation('name', $request->get('name'))
            )
            ->when(
                $request->has('date'),
                fn($query) => $query->orderBy('created_at', $request->get('date'))
            );

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $products = $products->paginate($per_page);

            return ProductResource::collection($products)->appends($request->query());
        } else {
            $products = $products->get();
        }

        return ProductResource::collection($products);
    }

    public function show(Request $request)
    {
        $product = Product::with([
            'translation',
            'category.products' => fn($query) => $query->inStock(),
            'category.products.brand',
            'images',
            'brand',
            'attributeValues'
        ])->findOrFail($request->id);

        $similarProducts = $product->category->products->reject(
            fn($value) => $value->id === $product->id
        )->take(9)->loadMissing('images');

        $similarBrands = $product->category->products->map(
            fn($product) => $product->brand
        )->unique('id')->filter(
            fn($brand) => $brand->id
        );;

        return response()->json([
            'product' => new ProductResource($product),
            'characteristics' => AttributeResource::collection($product->attributeValues),
            'similar_products' => ProductResource::collection($similarProducts),
            'similar_brands' => $similarBrands,
        ]);
    }

    public function cartProductCheck(Request $request)
    {
        $validator = Validator::make($request->post(), [
            'product_ids' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $products = Product::inStock()
            ->whereIn('id', $request->product_ids)
            ->get();

        return ProductResource::collection($products);
    }
}
