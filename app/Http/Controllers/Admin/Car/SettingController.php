<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdSettingsRequest;
use App\Settings\AdSettings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @param AdSettings $adSettings
     * @return Factory|View|Application
     */
    public function edit(AdSettings $adSettings): Factory|View|Application
    {
        return view('admin.car-ads.settings.edit', compact('adSettings'));
    }

    /**
     * @param AdSettings $adSettings
     * @param AdSettingsRequest $request
     * @return RedirectResponse
     */
    public function update(AdSettings $adSettings, AdSettingsRequest $request): RedirectResponse
    {
        $adSettings->archive_day_limit = $request->input('archive_day_limit');
        $adSettings->save();
        toast(__('Saved successfully'), 'success');

        return redirect()->back();
    }
}
