<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AdSettings extends Settings
{
    public int $archive_day_limit;

    public static function group(): string
    {
        return 'ad';
    }
}
