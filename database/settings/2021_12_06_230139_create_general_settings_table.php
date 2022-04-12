<?php

use Spatie\LaravelSettings\Exceptions\SettingAlreadyExists;
use Spatie\LaravelSettings\Exceptions\SettingDoesNotExist;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettingsTable extends SettingsMigration
{
    /**
     * @return void
     * @throws SettingAlreadyExists
     */
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Ýakyndar');
        $this->migrator->add('general.site_active', true);
    }

    /**
     * @return void
     * @throws SettingDoesNotExist
     */
    public function down(): void
    {
        $this->migrator->delete('general.site_name');
        $this->migrator->delete('general.site_active');
    }
}
