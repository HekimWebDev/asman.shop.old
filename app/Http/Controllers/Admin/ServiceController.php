<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Traits\ImageUpload;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with([
            'translation',
            'serviceCategory.translation'
        ])->get();

        return view('admin.services.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceCategories = ServiceCategory::with([
            'translation'
        ])->get();

        return view('admin.services.services.create', compact('serviceCategories'));
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
                '%description%' => 'nullable|string',
                '%owner%' => 'nullable|string',
                '%address%' => 'required|string',
            ])
        );

        $request->validate([
            'service_category_id' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'image' => 'required|mimes:png,jpg,webp',
            'status' => 'boolean',
        ]);

        $service = Service::create($request->post());

        $service->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $service->image = $this->storeImage($request->file('image'), 'services');
        }

        $service->save();

        return redirect()->route('admin.service.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $serviceCategories = ServiceCategory::with([
            'translation'
        ])->get();

        // $service = $service->loadMissing('translations');

        return view('admin.services.services.edit', compact('service', 'serviceCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
                '%description%' => 'nullable|string',
                '%owner%' => 'nullable|string',
                '%address%' => 'required|string',
            ])
        );

        $request->validate([
            'service_category_id' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'image' => 'nullable|mimes:png,jpg,webp',
            'status' => 'boolean',
        ]);

        $service->update($request->post());
        $service->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $this->destroyImage($service->image);
            $service->image = $this->storeImage($request->file('image'), 'services');
        }

        $service->save();

        return redirect()->route('admin.service.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->destroyImage($service->image);
        $service->delete();
        return redirect()->back();
    }
}
