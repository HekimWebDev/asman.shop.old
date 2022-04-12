<?php

use Spatie\LaravelSettings\Exceptions\SettingAlreadyExists;
use Spatie\LaravelSettings\Exceptions\SettingDoesNotExist;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateContactSettings extends SettingsMigration
{
    /**
     * @return void
     * @throws SettingAlreadyExists
     */
    public function up(): void
    {
        $this->migrator->add('contact.email', 'info@site.com');
        $this->migrator->add('contact.phone_number', '+993 61234567');
        $this->migrator->add('contact.business_number', '+993 61234567');
        $this->migrator->add('contact.working_time_start', '09:00');
        $this->migrator->add('contact.working_time_end', '18:00');
        $this->migrator->add('contact.business_address_tk', 'Lorem ipsum sit amet.');
        $this->migrator->add('contact.business_address_en', 'Lorem ipsum sit amet.');
        $this->migrator->add('contact.business_address_ru', 'Lorem ipsum sit amet.');
        $this->migrator->add('contact.about_us_tk', 'Lorem ipsum sit amet.');
        $this->migrator->add('contact.about_us_en', 'Lorem ipsum sit amet.');
        $this->migrator->add('contact.about_us_ru', 'Lorem ipsum sit amet.');
    }

    /**
     * @return void
     * @throws SettingDoesNotExist
     */
    public function down(): void
    {
        $this->migrator->delete('contact.email');
        $this->migrator->delete('contact.phone_number');
        $this->migrator->delete('contact.business_number');
        $this->migrator->delete('contact.working_time_start');
        $this->migrator->delete('contact.working_time_end');
        $this->migrator->delete('contact.business_address_tk');
        $this->migrator->delete('contact.business_address_en');
        $this->migrator->delete('contact.business_address_ru');
        $this->migrator->delete('contact.about_us_tk');
        $this->migrator->delete('contact.about_us_en');
        $this->migrator->delete('contact.about_us_ru');
    }
}
