<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsSettingsRequest;
use App\Settings\AboutUsSettings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AboutUsController extends Controller
{
    /**
     * @param AboutUsSettings $aboutUsSettings
     * @return Factory|View|Application
     */
    public function edit(AboutUsSettings $aboutUsSettings): Application|Factory|View
    {
        return view('admin.settings.about-us.edit', compact('aboutUsSettings'));
    }

    /**
     * @param AboutUsSettings $aboutUsSettings
     * @param AboutUsSettingsRequest $request
     * @return RedirectResponse
     */
    public function update(AboutUsSettings $aboutUsSettings, AboutUsSettingsRequest $request): RedirectResponse
    {
        $aboutUsSettings->title = $request->input('title');
        $aboutUsSettings->description = $request->input('description');
        $aboutUsSettings->feature_1_title = $request->input('feature_1_title');
        $aboutUsSettings->feature_1_description = $request->input('feature_1_description');
        $aboutUsSettings->feature_2_title = $request->input('feature_2_title');
        $aboutUsSettings->feature_2_description = $request->input('feature_2_description');
        $aboutUsSettings->feature_3_title = $request->input('feature_3_title');
        $aboutUsSettings->feature_3_description = $request->input('feature_3_description');
        $aboutUsSettings->feature_4_title = $request->input('feature_4_title');
        $aboutUsSettings->feature_4_description = $request->input('feature_4_description');
        $aboutUsSettings->feature_5_title = $request->input('feature_5_title');
        $aboutUsSettings->feature_5_description = $request->input('feature_5_description');
        $aboutUsSettings->feature_6_title = $request->input('feature_6_title');
        $aboutUsSettings->feature_6_description = $request->input('feature_6_description');

        $aboutUsSettings->save();
        toast(__('Saved successfully'), 'success');

        return redirect()->back();
    }
}
