<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::withCount('products')->get();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:70',
            'image' => 'required|mimes:png,jpg,webp',
            'status' => 'boolean',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'status' => $request->status === null ? 0 : $request->status,
        ]);

        $brand->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $brand->image = $this->storeImage($request->file('image'), 'brands');
            $brand->save();
        }

        $brand->save();

        return redirect()->route('admin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:70',
            'image' => 'nullable|mimes:png,jpg,webp',
            'status' => 'boolean',
        ]);

        $brand->update([
            'name' => $request->name,
            'status' => $request->status === null ? 0 : $request->status,
        ]);

        $brand->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $this->destroyImage($brand->image);
            $brand->image = $this->storeImage($request->file('image'), 'brands');
            $brand->save();
        }

        $brand->save();

        return redirect()->route('admin.brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $this->destroyImage($brand->image);
        $brand->delete();
        return redirect()->back();
    }
}
