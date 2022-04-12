<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactSettings extends Settings
{
    public string $email;
    public string $phone_number;
    public string $business_number;
    public string $working_time_start;
    public string $working_time_end;
    public string $business_address_tk;
    public string $business_address_en;
    public string $business_address_ru;
    public string $about_us_tk;
    public string $about_us_en;
    public string $about_us_ru;

    public static function group(): string
    {
        return 'contact';
    }
}
