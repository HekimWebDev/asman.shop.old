<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = QueryBuilder::for(Category::class)
            ->whereOneCParentId($request->filter['parent_id'] ?? null)
            ->allowedFilters([
                AllowedFilter::exact('parent_id', 'one_c_parent_id'),
            ])
            ->active()
            ->with([
                'translation',
                'childs' => fn ($query) => $query->active()->with('translation'),
            ])
            ->withCount([
                'products' => fn ($query) => $query->inStock(),
            ])
            ->orderBy('position', 'asc')
            ->take($request->limit)
            ->get();

        return response()->json(CategoryResource::collection($categories));
    }

    public function products(Request $request)
    {
        $category = Category::whereTranslation('slug', $request->slug)
            ->with([
                'childs' => fn ($query) => $query->active(),
                'products' => fn ($query) => $query->inStock(),
                'products.translation',
                'products.brand'
            ])
            ->withCount([
                'products' => fn ($query) => $query->inStock(),
            ])
            ->first();

        return response(new CategoryResource($category));
    }

    public function brands(Request $request)
    {
        $category = Category::whereTranslation('slug', $request->slug)
            ->with([
                'products' => fn ($query) => $query->inStock(),
                'products.brand'
            ])
            ->first();
        $products = $category->products;

        $product_ids = $products->map(
            fn ($product) => $product->id
        );

        $brand_ids = $products->map(
            fn ($product) => $product->brand->id
        )->filter()->unique();

        $brands = Brand::withCount([
            'products' => fn ($query) => $query->whereIn('id', $product_ids)
        ])->find($brand_ids);

        return response(BrandResource::collection($brands));
    }

    public function mainCategories(Request $request)
    {
        $mainCategories = Category::active()
            ->where('is_main', true)
            ->with([
                'childs' => fn ($query) => $query->active()
                    ->withCount([
                        'products' => fn ($query) => $query->inStock(),
                    ]),
            ])
            ->withCount([
                'products' => fn ($query) => $query->inStock(),
            ])
            ->take($request->limit)
            ->get();

        // $mainCategories->each(function ($category) {
        //     $category->total_products_count = $category->products_count;
        //     $category->total_products_count = $category->childs->sum(
        //         fn ($child) => $child->products_count
        //     );
        // });

        return response(CategoryResource::collection($mainCategories));
    }
}
