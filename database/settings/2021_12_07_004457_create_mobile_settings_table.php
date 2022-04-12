<?php

use Spatie\LaravelSettings\Exceptions\SettingAlreadyExists;
use Spatie\LaravelSettings\Exceptions\SettingDoesNotExist;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateMobileSettingsTable extends SettingsMigration
{
    /**
     * @return void
     * @throws SettingAlreadyExists
     */
    public function up(): void
    {
        $this->migrator->add('mobile.app_version', '1.0.0');
        $this->migrator->add('mobile.app_active', true);
    }

    /**
     * @return void
     * @throws SettingDoesNotExist
     */
    public function down(): void
    {
        $this->migrator->delete('mobile.app_version');
        $this->migrator->delete('mobile.app_active');
    }
}
