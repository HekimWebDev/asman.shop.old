<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutUsSettings extends Settings
{
    public array $title;
    public array $description;
    public array $feature_1_title;
    public array $feature_1_description;
    public array $feature_2_title;
    public array $feature_2_description;
    public array $feature_3_title;
    public array $feature_3_description;
    public array $feature_4_title;
    public array $feature_4_description;
    public array $feature_5_title;
    public array $feature_5_description;
    public array $feature_6_title;
    public array $feature_6_description;

    public static function group(): string
    {
        return 'about_us';
    }
}
