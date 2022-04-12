<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\ProductResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()
            ->orderBy('position', 'asc')
            ->whereOneCParentId(null);

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $categories = $categories->paginate($per_page);

            return CategoryResource::collection($categories)->appends([
                'per_page' => $per_page
            ]);
        } else {
            $categories = $categories->get();
        }

        return CategoryResource::collection($categories);
    }

    public function show(Request $request)
    {
        $categories = Category::findOrFail($request->id)
            ->childs()->active();

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $categories = $categories->paginate($per_page);

            return CategoryResource::collection($categories)->appends([
                'per_page' => $per_page
            ]);
        } else {
            $categories = $categories->get();
        }

        return CategoryResource::collection($categories);
    }

    public function brands(Request $request)
    {
        $category = Category::with([
            'products' => fn ($query) => $query->inStock()->has('brand'),
        ])->findOrFail($request->id);

        $brands = $category->products->map(
            fn ($product) => $product->brand
        )->unique();

        return BrandResource::collection($brands);
    }

    public function products(Request $request)
    {
        $products = Category::findOrFail($request->id)->products()->inStock()
            ->when(
                $request->has('q'),
                fn ($query) => $query->whereTranslationLike('name', '%' . $request->q . '%', $request->lang)
            )
            ->when(
                $request->boolean('discount'),
                fn ($query) => $query->whereNotNUll('discount_price')
            )
            ->when(
                $request->has('brand'),
                fn ($query) => $query->whereIn('brand_id', explode(',', $request->get('brand')))
            )
            ->when(
                $request->has(['min_price', 'max_price']),
                fn ($query) => $query->whereBetween('price', [$request->min_price, $request->max_price])
                    ->orWhereBetween('discount_price', [$request->min_price, $request->max_price])
            )
            ->when(
                $request->has('price'),
                fn ($query) => $query->orderBy('price', $request->get('price'))
            )
            ->when(
                $request->has('name'),
                fn ($query) => $query->orderByTranslation('name', $request->get('name'))
            )
            ->when(
                $request->has('date'),
                fn ($query) => $query->orderBy('created_at', $request->get('date'))
            );

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $products = $products->paginate($per_page);

            return ProductResource::collection($products)->appends([
                'per_page' => $per_page
            ]);
        } else {
            $products = $products->get();
        }

        return ProductResource::collection($products);
    }

    public function attributes(Request $request)
    {
        $categoryIds = Category::findOrFail($request->id)->getAllChildren()->pluck('id');
        $categoryIds->prepend((int) $request->id);

        $products = Product::inStock()
            ->whereHas(
                'category',
                fn ($query) => $query->whereIn('id', $categoryIds)
            )
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