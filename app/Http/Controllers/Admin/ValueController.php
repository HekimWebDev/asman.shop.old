<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class ValueController extends Controller
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
        $attributes = Attribute::with([
            'translation'
        ])->get();

        return view('admin.attribute-values.modals.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate(
        //     RuleFactory::make([
        //         '%name%' => 'required|string',
        //     ])
        // );

        $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'name_tk' => 'required|string',
            'name_en' => 'required|string',
            'name_ru' => 'required|string',
            'status' => 'boolean',
        ]);

        $attributeValue = AttributeValue::create([
            'attribute_id' => $request->attribute_id,
            'tk' => ['name' => $request->name_tk],
            'en' => ['name' => $request->name_en],
            'ru' => ['name' => $request->name_ru],
        ]);
        $attributeValue->status = $request->status === null ? 0 : $request->status;
        $attributeValue->save();

        return response()->json(['message' => 'Attribute value successfully created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeValue $attributeValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attributeValue)
    {
        //
    }
}
