<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCategoryResource;
use App\Http\Resources\ServiceResource;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::active()
            ->hasActiveServices()
            ->with('translation')
            ->withCount([
                'services' => fn ($query) => $query->active()
            ])
            ->get();

        return response(ServiceCategoryResource::collection($serviceCategories));
    }

    public function show(Request $request)
    {
        $serviceCategory = ServiceCategory::whereTranslation('slug', $request->slug)
            ->active()
            ->with([
                'services' => fn ($query) => $query->active()
            ])
            ->firstOrFail();

        return response(new ServiceCategoryResource($serviceCategory));
    }

    public function showService(Request $request)
    {
        $serviceCategory = ServiceCategory::whereTranslation('slug', $request->serviceCategorySlug)
            ->active()
            ->firstOrFail();

        $service = $serviceCategory->services()
            ->whereTranslation('slug', $request->serviceSlug)
            ->active()
            ->with([
                'serviceCategory' => fn ($query) => $query->active()
            ])
            ->firstOrFail();

        return response(new ServiceResource($service));
    }
}
