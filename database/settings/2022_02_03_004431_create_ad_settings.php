<?php

use Spatie\LaravelSettings\Exceptions\SettingAlreadyExists;
use Spatie\LaravelSettings\Exceptions\SettingDoesNotExist;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateAdSettings extends SettingsMigration
{
    /**
     * @return void
     * @throws SettingAlreadyExists
     */
    public function up(): void
    {
        $this->migrator->add('ad.archive_day_limit', 40);
    }

    /**
     * @return void
     * @throws SettingDoesNotExist
     */
    public function down(): void
    {
        $this->migrator->delete('ad.archive_day_limit');
    }
}
