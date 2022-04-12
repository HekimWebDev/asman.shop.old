<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use App\Models\AttributeGroupTranslation;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute-groups.create');
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

        $attributeGroup = AttributeGroup::create($request->post());
        $attributeGroup->status = $request->status === null ? 0 : $request->status;
        $attributeGroup->save();

        return session('previous_url')
            ? redirect(session('previous_url'))
            : redirect()->route('admin.attributes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeGroup $attributeGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeGroup $attributeGroup)
    {
        return view('admin.attribute-groups.edit', compact('attributeGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeGroup $attributeGroup)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
            ])
        );

        $request->validate([
            'status' => 'boolean',
        ]);

        $attributeGroup->update($request->post());
        $attributeGroup->status = $request->status === null ? 0 : $request->status;
        $attributeGroup->save();

        return session('previous_url')
            ? redirect(session('previous_url'))
            : redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeGroup $attributeGroup)
    {
        $attributeGroup->delete();
        return redirect()->back();
    }
}
