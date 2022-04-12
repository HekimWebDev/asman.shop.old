<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AttributesImport;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attribute_groups = AttributeGroup::with('translation')->get();
        $request->group_id
            ? $attributes = Attribute::whereAttributeGroupId($request->group_id)
            ->with(['translation', 'attributeValues'])
            ->withCount('attributeValues')
            ->get()
            : $attributes = null;

        session()->put('previous_url', request()->fullUrl());

        return view('admin.attributes.index', compact('attribute_groups', 'attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute_groups = AttributeGroup::with('translation')->get();
        return view('admin.attributes.create', compact('attribute_groups'));
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
            'attribute_group_id' => 'required',
            'status' => 'boolean',
        ]);

        $attribute = Attribute::create($request->post());
        $attribute->status = $request->status === null ? 0 : $request->status;
        $attribute->save();

        return session('previous_url')
            ? redirect(session('previous_url'))
            : redirect()->route('admin.attributes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $attribute_groups = AttributeGroup::all();
        return view('admin.attributes.edit', compact('attribute', 'attribute_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
                '%description%' => 'nullable|string',
            ])
        );

        $request->validate([
            'attribute_group_id' => 'required',
            'status' => 'boolean',
        ]);

        $attribute->update($request->post());
        $attribute->status = $request->status === null ? 0 : $request->status;
        $attribute->save();

        return session('previous_url')
            ? redirect(session('previous_url'))
            : redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->back();
    }

    public function import()
    {
        return view('admin.attributes.import');
    }

    public function importPost(Request $request)
    {
        Excel::import(new AttributesImport, $request->file('file'));

        return redirect()->back();
    }

    public function selectAttributeValue(Request $request)
    {
        $attributes = Attribute::whereTranslationLike('name', '%' . $request->q . '%', app()->getLocale())
            ->orWhereHas(
                'attributeValues',
                fn ($query) => $query->whereTranslationLike('name', '%' . $request->q . '%', app()->getLocale())
            )
            ->with([
                'translation',
                'attributeValues' => fn ($query) => $query->orderByTranslation('name')
            ])
            ->orderByTranslation('name')
            ->get();

        $attributes = $attributes->map(
            function ($attribute) {
                return [
                    'text' => $attribute->name,
                    'children' => $attribute->attributeValues->map(
                        function ($attributeValue) {
                            return [
                                'id' => $attributeValue->id,
                                'text' => $attributeValue->name,
                            ];
                        }
                    ),
                    'pagination' => [
                        'more' => true
                    ]
                ];
            }
        );

        return response()->json($attributes);
    }

    public function selectAttribute(Request $request)
    {
        $attributes = Attribute::whereTranslationLike('name', '%' . $request->q . '%', app()->getLocale())
            ->with('translation')
            ->orderByTranslation('name')
            ->get();

        $attributes = $attributes->map(
            function ($attribute) {
                return [
                    'id' => $attribute->id,
                    'text' => $attribute->name,
                ];
            }
        );

        return response()->json($attributes);
    }
}