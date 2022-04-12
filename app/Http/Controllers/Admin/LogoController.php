<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogoController extends Controller
{
    use ImageUpload;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        return view('admin.logos.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'image|mimes:png,jpg,webp',
            'small_logo' => 'image|mimes:png,jpg,webp',
        ]);

        if ($request->file('logo')) {
            $this->destroyImage($logo->logo);
            $logo->logo = $this->storeImage($request->file('logo'), 'logos');
        }

        if ($request->file('small_logo')) {
            $this->destroyImage($logo->small_logo);
            $logo->small_logo = $this->storeImage($request->file('small_logo'), 'logos');
        }

        if ($request->file('favicon') && $request->file('favicon')->getClientOriginalExtension() === 'ico') {
            if (File::exists($logo->favicon)) {
                File::delete($logo->favicon);
            }
            $fileName = time() . '_' . $request->file('favicon')->getClientOriginalName();
            $filePath = $request->file('favicon')->storeAs('favicon', $fileName, 'public');
            $logo->favicon = 'storage/' . $filePath;
        }

        $logo->update();

        return redirect()->route('admin.logos.edit', $logo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        //
    }
}
