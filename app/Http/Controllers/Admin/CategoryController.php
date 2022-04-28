<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Imports\CategoriesImport;
use App\Traits\ImageUpload;
use App\Models\Category;
use App\ViewModels\CategoryViewModel;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('descendants')
            ->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereIsRoot()->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryFormRequest $request): RedirectResponse
    {
        $data = $request->validated();

        CategoryViewModel::all($request, $data);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryFormRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();

        CategoryViewModel::all($request, $data, $category);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $media = $category->media()->get();
        $media->each(fn($m) => $m->delete());
        $category->delete();
        return redirect()->back();
    }

    public function import()
    {
        return view('admin.categories.import');
    }
}
