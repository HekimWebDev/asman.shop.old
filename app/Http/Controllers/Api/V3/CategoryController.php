<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()
            ->whereOneCParentId(null)
            ->when(
                $request->is_main,
                fn($query) => $query->where('is_main', $request->boolean('is_main'))
            )
            ->when(
                $request->offset,
                fn($query) => $query->skip($request->offset)
            )
            ->when(
                $request->limit,
                fn($query) => $query->take($request->limit)
            )
            ->orderBy('position', 'asc')
            ->with([
                'childs' => fn($query) => $query->active()
            ])
            ->get();

        return CategoryResource::collection($categories)
            ->additional([
                'result' => $categories->count()
            ]);
    }
}
