<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Traits\ImageUpload;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceCategories = ServiceCategory::with([
            'translation'
        ])
            ->withCount([
                'services'
            ])->get();

        return view('admin.services.categories.index', compact('serviceCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
            ])
        );

        $request->validate([
            'status' => 'boolean',
        ]);

        $serviceCategory = ServiceCategory::create($request->post());
        $serviceCategory->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $serviceCategory->image = $this->storeImage($request->file('image'), 'service-categories');
        }

        $serviceCategory->save();

        return redirect()->route('admin.service.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceCategory $category)
    {
        return view('admin.services.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceCategory $category)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
            ])
        );

        $request->validate([
            'name.*' => 'required|string',
            'status' => 'boolean',
        ]);

        $category->update($request->post());
        $category->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $this->destroyImage($category->image);
            $category->image = $this->storeImage($request->file('image'), 'service-categories');
        }

        $category->save();

        return redirect()->route('admin.service.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceCategory $category)
    {
        $this->destroyImage($category->image);
        $category->delete();
        return redirect()->back();
    }
}
