<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V3\AboutUsSettingResource;
use App\Settings\AboutUsSettings;
use JetBrains\PhpStorm\Pure;

class AboutUsSettingController extends Controller
{
    /**
     * @param AboutUsSettings $aboutUsSettings
     * @return AboutUsSettingResource
     */
    #[Pure] public function __invoke(AboutUsSettings $aboutUsSettings): AboutUsSettingResource
    {
        return new AboutUsSettingResource($aboutUsSettings);
    }
}
