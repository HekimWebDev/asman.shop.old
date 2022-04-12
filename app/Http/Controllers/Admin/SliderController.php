<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUpload;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('translation')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        set_time_limit(0);

        $request->validate(
            RuleFactory::make([
                '%image%' => 'required|mimes:png,jpg,webp'
            ])
        );

        $request->validate([
            'status' => 'boolean',
            'link' => 'nullable|url'
        ]);

        if ($request->file('image:tk') && $request->file('image:en') && $request->file('image:ru')) {
            $imageTk = $this->storeImage($request->file('image:tk'), 'sliders');
            $imageEn = $this->storeImage($request->file('image:en'), 'sliders');
            $imageRu = $this->storeImage($request->file('image:ru'), 'sliders');

            $slider = Slider::create([
                'link' => $request->link,
                'tk' => ['image' => $imageTk],
                'en' => ['image' => $imageEn],
                'ru' => ['image' => $imageRu]
            ]);
        }

        $slider->status = $request->status === null ? 0 : $request->status;
        $slider->save();

        return redirect()->route('admin.sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        set_time_limit(0);

        $request->validate(
            RuleFactory::make([
                '%image%' => 'nullable|mimes:png,jpg,webp'
            ])
        );

        $request->validate([
            'status' => 'boolean',
            'link' => 'nullable|url'
        ]);

        if ($request->file('image:tk')) {
            $this->destroyImage($slider->translate('tk')->image);
            $slider->translate('tk')->image = $this->storeImage($request->file('image:tk'), 'sliders');
        }

        if ($request->file('image:en')) {
            $this->destroyImage($slider->translate('en')->image);
            $slider->translate('en')->image = $this->storeImage($request->file('image:en'), 'sliders');
        }

        if ($request->file('image:ru')) {
            $this->destroyImage($slider->translate('ru')->image);
            $slider->translate('ru')->image = $this->storeImage($request->file('image:ru'), 'sliders');
        }

        $slider->link = $request->link;
        $slider->status = $request->status === null ? 0 : $request->status;
        $slider->save();

        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $this->destroyImage($slider->translate('tk')->image);
        $this->destroyImage($slider->translate('en')->image);
        $this->destroyImage($slider->translate('ru')->image);
        $slider->delete();
        return redirect()->back();
    }
}
