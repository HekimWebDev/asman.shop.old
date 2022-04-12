<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\AttributeResource;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $attributes = Attribute::has('attributeValues')
            ->when(
                $request->filled('category_id'),
                function ($query) use ($request) {
                    $category = Category::with('children')->find($request->get('category_id'));
                    if ($category) {
                        $categoryIds = $category->getAllChildren()->pluck('one_c_id');
                        $categoryIds->prepend($category->one_c_id);

                        $query->whereHas(
                            'attributeValues.products',
                            fn($query) => $query->whereIn('one_c_category_id', $categoryIds)->inStock()
                        );
                    }
                }
            )
            ->with([
                'attributeValues' => fn($query) => $query->with('translations')
                    ->orderByTranslation('name'),
            ])
            ->orderByTranslation('name');

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $attributes = $attributes->paginate($per_page);

            return AttributeResource::collection($attributes)->appends($request->query());
        } else {
            $attributes = $attributes->get();
        }

        return AttributeResource::collection($attributes);
    }
}
