<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\AttributeValueTranslation;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attribute $attribute)
    {
        $attributeValues = AttributeValue::whereAttributeId($attribute->id)
            ->with('translation')
            ->get();

        return view('admin.attribute-values.index', compact('attributeValues', 'attribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Attribute $attribute)
    {
        return view('admin.attribute-values.create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Attribute $attribute)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
            ])
        );

        $request->validate([
            'status' => 'boolean',
        ]);

        $attributeValue = $attribute->attributeValues()->create($request->post());
        $attributeValue->status = $request->status === null ? 0 : $request->status;
        $attributeValue->save();

        return redirect()->route('admin.attributes.index');
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
    public function edit(AttributeValue $attributeValue, Attribute $attribute, $value)
    {
        $attributeValue = $attributeValue->whereId($value)->whereAttributeId($attribute->id)->firstOrFail();
        return view('admin.attribute-values.edit', compact('attributeValue', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute, $value)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
            ])
        );

        $request->validate([
            'status' => 'boolean',
        ]);

        $attributeValue = $attribute->attributeValues()->find($value);
        $attributeValue->update($request->post());
        $attributeValue->status = $request->status === null ? 0 : $request->status;
        $attributeValue->save();

        return redirect()->route('admin.attributes.values.index', $attribute->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeValue  $attributeValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attributeValue, Attribute $attribute, $value)
    {
        $attributeValue->whereId($value)->whereAttributeId($attribute->id)->delete();

        return redirect()->back();
    }
}
