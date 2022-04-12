<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CategoriesImport;
use App\Traits\ImageUpload;
use App\Models\Category;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $categories)
    {
        $parent = null;

        if (!isset($request->show)) {
            $categories = Category::whereOneCParentId(null)
                ->orderBy('position', 'asc');
        } else if (is_numeric($request->show)) {
            $parent = Category::with('translation')->findOrFail($request->show);
            $categories = Category::whereOneCParentId($parent->one_c_id);
        }


        $categories = $categories->with('childs', 'translation')
            ->withCount('products', 'categories')
            ->get()
            ->chunk(10);

        return view('admin.categories.index', compact('categories', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereOneCParentId(null)
            ->with('childs', 'translation')
            ->get();
        return view('admin.categories.create', compact('categories'));
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
            ])
        );

        $request->validate([
            'parent_id' => 'required',
            'image' => 'required|mimes:png,jpg,webp',
            'icon' => 'nullable|string',
            'status' => 'boolean',
            'banner' => 'nullable|mimes:png,jpg,webp'
        ]);

        $request->merge(['parent_id' => ($request->parent_id === 'null') ? null : $request->parent_id]);

        $category = Category::create($request->post());
        $category->status = $request->status === null ? 0 : $request->status;

        if ($request->file('image')) {
            $category->image = $this->storeImage($request->file('image'), 'categories');
            $category->save();
        }

        if ($request->file('banner')) {
            $category->banner = $this->storeImage($request->file('banner'), 'category-banners');
            $category->save();
        }

        $category->save();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category);
        $categories = Category::whereOneCParentId(null)->with('childs')->withTranslation()->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
                '%description%' => 'nullable|string',
            ])
        );

        $request->validate([
            'image' => 'nullable|mimes:png,jpg,webp',
            'icon' => 'nullable|mimes:svg',
            'is_main' => 'boolean',
            'status' => 'boolean',
        ]);

        $category->update($request->post());
        $category->status = $request->status === null ? 0 : $request->status;
        $category->is_main = $request->is_main === null ? 0 : $request->is_main;

        if ($request->file('image')) {
            $this->destroyImage($category->image);
            $category->image = $this->storeImage($request->file('image'), 'categories');
            $category->save();
        }

        if ($request->file('icon')) {
            File::delete('storage/' . $category->icon);
            $fileName = $request->file('icon')->hashName();
            $category->icon = $request->file('icon')->storeAs('category-icons', $fileName, 'public');
        }

        $category->save();

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->destroyImage($category->image);
        $category->delete();
        return redirect()->back();
    }

    public function import()
    {
        return view('admin.categories.import');
    }

    public function importPost(Request $request)
    {
        Excel::import(new CategoriesImport, $request->file('file'));

        return redirect()->back();
    }

    public function position(Request $request)
    {
        $categories = Category::whereOneCParentId(null)
            ->with('translation')
            ->orderBy('position', 'asc')
            ->get();
        // $childs = collect();

        return view('admin.categories.position', compact('categories'));
    }

    public function updatePosition(Request $request)
    {
        if ($request->has('ids')) {
            $arr = explode(',', $request->input('ids'));

            foreach ($arr as $sortPosition => $id) {
                $category = Category::find($id);
                $category->position = $sortPosition;
                $category->save();
            }
            return ['success' => true, 'message' => 'Updated'];
        }
    }
}
