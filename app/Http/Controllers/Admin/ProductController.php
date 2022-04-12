<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\DataTables\ProductTrashDataTable;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductAttributesImport;
use App\Models\Attribute;
use App\Models\Block;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Traits\ImageUpload;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::whereParentId(null)->with('childs')->withTranslation()->get();
        $attributes = Attribute::with('attributeValues')->get();
        $brands = Brand::all();
        $blocks = Block::with('translation')->get();
        return view('admin.products.create', compact('categories', 'attributes', 'brands', 'blocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
                '%description%' => 'required|string',
            ])
        );

        $request->validate([
            'category_id' => 'required',
            'block_id' => 'nullable',
            'brand_id' => 'required',
            'quantity' => 'required|numeric',
            'discount_price' => 'nullable',
            'attribute_value_id' => 'nullable',
            'image.*' => 'required|mimes:png,jpg,webp',
            'price' => 'required|numeric',
            'status' => 'boolean',
            'hit' => 'boolean',
        ]);

        $product = Product::create($request->post());

        $product->status = $request->status === null ? 0 : $request->status;
        $product->hit = $request->hit === null ? 0 : $request->hit;

        $product->categories()->sync($request->category_id);
        $product->blocks()->sync($request->block_id);
        $product->attributeValues()->sync($request->attribute_value_id);

        if ($request->file('image')) {
            $product->image = $this->storeImage($request->file('image'), 'products');
        }

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $this->storeImage($image, 'products'),
                ]);
            }
        }

        $product->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = Category::whereParentId(null)
            ->with('childs', 'translations')
            ->get();
        $product->with(['categories', 'translation', 'blocks']);
        $attributes = Attribute::with('attributeValues')->get();
        $brands = Brand::all();
        $blocks = Block::with('translation')->get();
        return view('admin.products.edit', compact('product', 'categories', 'attributes', 'brands', 'blocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'nullable|string',
                '%description%' => 'nullable|string',
            ])
        );

        $request->validate([
            // 'block_id' => 'nullable',
            'brand_id' => 'nullable',
            'quantity' => 'nullable|numeric',
            'discount_price' => 'nullable',
            'attribute_value_id' => 'nullable',
            'image.*' => 'nullable|mimes:png,jpg,webp',
            'price' => 'nullable|numeric',
            'status' => 'boolean',
            'hit' => 'boolean',
        ]);

        $product->update($request->post());

        $product->status = $request->status === null ? 0 : $request->status;
        $product->hit = $request->hit === null ? 0 : $request->hit;

        $product->blocks()->sync($request->block_id);
        $product->attributeValues()->sync($request->attribute_value_id);

        if ($request->file('image')) {
            $this->destroyImage($product->image);
            $product->image = $this->storeImage($request->file('image'), 'products');
        }

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $this->storeImage($image, 'products'),
                ]);
            }
        }

        $product->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

    public function trash(ProductTrashDataTable $dataTable)
    {
        return $dataTable->render('admin.products.trash');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        Product::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    /**
     * @return RedirectResponse
     */
    public function restoreAll(): RedirectResponse
    {
        Product::onlyTrashed()->restore();
        return redirect()->back();
    }

    public function deleteImage(Request $request)
    {
        $image = ProductImage::findOrFail($request->id);
        $this->destroyImage($image->image);
        $image->delete();
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function attributesImport()
    {
        return view('admin.products.attributes.import');
    }

    public function attributesImportPost(Request $request)
    {
        Excel::import(new ProductAttributesImport, $request->file('file'));

        return redirect()->back();
    }
}
