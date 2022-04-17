<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageUpload;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $brands = Brand::withCount('products')->get();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:70',
            'image' => 'required|mimes:png,jpg,webp',
            'status' => 'boolean',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'status' => $request->status ?? 0,
        ]);

        $brand->status = $request->status ?? 0; // Name ucin gerek???   

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
     * @param Brand $brand
     * @return void
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return Application|Factory|View
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:70',
            'image' => 'nullable|mimes:png,jpg,webp',
            'status' => 'boolean',
        ]);

        $brand->update([
            'name' => $request->name,
            'status' => $request->status ?? 0,
        ]);

        $brand->status = $request->status ?? 0;

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
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        $this->destroyImage($brand->image);
        $brand->delete();
        return redirect()->back();
    }
}
