<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class Mobile extends Settings
{
    public string $app_version;
    public bool $app_active;

    public static function group(): string
    {
        return 'mobile';
    }
}
