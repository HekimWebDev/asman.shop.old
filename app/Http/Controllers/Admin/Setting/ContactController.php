<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactSettingsRequest;
use App\Settings\ContactSettings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @param ContactSettings $contactSettings
     * @return Factory|View|Application
     */
    public function edit(ContactSettings $contactSettings): View|Factory|Application
    {
        return view('admin.settings.contact.edit', compact('contactSettings'));
    }

    /**
     * @param ContactSettings $contactSettings
     * @param ContactSettingsRequest $request
     * @return RedirectResponse
     */
    public function update(ContactSettings $contactSettings, ContactSettingsRequest $request): RedirectResponse
    {
        $contactSettings->email = $request->input('email');
        $contactSettings->phone_number = $request->input('phone_number');
        $contactSettings->business_number = $request->input('business_number');
        $contactSettings->working_time_start = $request->input('working_time_start');
        $contactSettings->working_time_end = $request->input('working_time_end');
        $contactSettings->business_address_tk = $request->input('business_address_tk');
        $contactSettings->business_address_en = $request->input('business_address_en');
        $contactSettings->business_address_ru = $request->input('business_address_ru');
        $contactSettings->about_us_tk = $request->input('about_us_tk');
        $contactSettings->about_us_en = $request->input('about_us_en');
        $contactSettings->about_us_ru = $request->input('about_us_ru');

        $contactSettings->save();
        toast(__('Saved successfully'), 'success');

        return redirect()->back();
    }
}
