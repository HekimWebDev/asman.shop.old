<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $q = $request->q;

        $categories = Category::whereTranslationLike('name', '%' . $q . '%')
            ->active()
            ->get();

        $products = Product::whereTranslationLike('name', '%' . $q . '%')
            ->inStock()
            ->get();

        return response([
            'categories' => CategoryResource::collection($categories),
            'products' => ProductResource::collection($products)
        ]);
    }
}
