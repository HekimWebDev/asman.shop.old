<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V2\ContactSettingResource;
use App\Settings\ContactSettings;
use JetBrains\PhpStorm\Pure;

class ContactSettingController extends Controller
{
    /**
     * @param ContactSettings $contactSettings
     * @return ContactSettingResource
     */
    #[Pure] public function __invoke(ContactSettings $contactSettings): ContactSettingResource
    {
        return new ContactSettingResource($contactSettings);
    }
}
