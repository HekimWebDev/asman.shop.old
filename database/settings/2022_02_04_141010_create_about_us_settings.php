<?php

use Spatie\LaravelSettings\Exceptions\SettingAlreadyExists;
use Spatie\LaravelSettings\Exceptions\SettingDoesNotExist;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateAboutUsSettings extends SettingsMigration
{
    /**
     * @return void
     * @throws SettingAlreadyExists
     */
    public function up(): void
    {
        $this->migrator->add('about_us.title', [
            'tk' => 'About us Title',
            'en' => 'About us Title',
            'ru' => 'About us Title'
        ]);
        $this->migrator->add('about_us.description', [
            'tk' => 'About us Description',
            'en' => 'About us Description',
            'ru' => 'About us Description'
        ]);
        $this->migrator->add('about_us.feature_1_title', [
            'tk' => 'Feature 1 Title',
            'en' => 'Feature 1 Title',
            'ru' => 'Feature 1 Title'
        ]);
        $this->migrator->add('about_us.feature_1_description', [
            'tk' => 'Feature 1 Description',
            'en' => 'Feature 1 Description',
            'ru' => 'Feature 1 Description'
        ]);
        $this->migrator->add('about_us.feature_2_title', [
            'tk' => 'Feature 2 Title',
            'en' => 'Feature 2 Title',
            'ru' => 'Feature 2 Title'
        ]);
        $this->migrator->add('about_us.feature_2_description', [
            'tk' => 'Feature 2 Description',
            'en' => 'Feature 2 Description',
            'ru' => 'Feature 2 Description'
        ]);
        $this->migrator->add('about_us.feature_3_title', [
            'tk' => 'Feature 3 Title',
            'en' => 'Feature 3 Title',
            'ru' => 'Feature 3 Title'
        ]);
        $this->migrator->add('about_us.feature_3_description', [
            'tk' => 'Feature 3 Description',
            'en' => 'Feature 3 Description',
            'ru' => 'Feature 3 Description'
        ]);
        $this->migrator->add('about_us.feature_4_title', [
            'tk' => 'Feature 4 Title',
            'en' => 'Feature 4 Title',
            'ru' => 'Feature 4 Title'
        ]);
        $this->migrator->add('about_us.feature_4_description', [
            'tk' => 'Feature 4 Description',
            'en' => 'Feature 4 Description',
            'ru' => 'Feature 4 Description'
        ]);
        $this->migrator->add('about_us.feature_5_title', [
            'tk' => 'Feature 5 Title',
            'en' => 'Feature 5 Title',
            'ru' => 'Feature 5 Title'
        ]);
        $this->migrator->add('about_us.feature_5_description', [
            'tk' => 'Feature 5 Description',
            'en' => 'Feature 5 Description',
            'ru' => 'Feature 5 Description'
        ]);
        $this->migrator->add('about_us.feature_6_title', [
            'tk' => 'Feature 6 Title',
            'en' => 'Feature 6 Title',
            'ru' => 'Feature 6 Title'
        ]);
        $this->migrator->add('about_us.feature_6_description', [
            'tk' => 'Feature 6 Description',
            'en' => 'Feature 6 Description',
            'ru' => 'Feature 6 Description'
        ]);
    }

    /**
     * @return void
     * @throws SettingDoesNotExist
     */
    public function down(): void
    {
        $this->migrator->delete('about_us.title');
        $this->migrator->delete('about_us.description');
        $this->migrator->delete('about_us.feature_1_title');
        $this->migrator->delete('about_us.feature_1_description');
        $this->migrator->delete('about_us.feature_2_title');
        $this->migrator->delete('about_us.feature_2_description');
        $this->migrator->delete('about_us.feature_3_title');
        $this->migrator->delete('about_us.feature_3_description');
        $this->migrator->delete('about_us.feature_4_title');
        $this->migrator->delete('about_us.feature_4_description');
        $this->migrator->delete('about_us.feature_5_title');
        $this->migrator->delete('about_us.feature_5_description');
        $this->migrator->delete('about_us.feature_6_title');
        $this->migrator->delete('about_us.feature_6_description');
    }
}
