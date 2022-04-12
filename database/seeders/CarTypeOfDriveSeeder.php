<?php

namespace Database\Seeders;

use App\Models\CarTypeOfDrive;
use Illuminate\Database\Seeder;

class CarTypeOfDriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carTypeOfDrives = [
            [
                'tk' => ['name' => 'Manual'],
                'en' => ['name' => 'Manual'],
                'ru' => ['name' => 'Руководство по эксплуатации'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Awtomat'],
                'en' => ['name' => 'Automatic'],
                'ru' => ['name' => 'Автоматический'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Tiptronik'],
                'en' => ['name' => 'Tiptronic'],
                'ru' => ['name' => 'Типтроник'],
                'is_active' => true
            ],
        ];

        foreach ($carTypeOfDrives as $carTypeOfDrive) {
            $carTypeOfDriveModel = CarTypeOfDrive::whereTranslation('name', $carTypeOfDrive['tk'], 'tk')
                ->whereTranslation('name', $carTypeOfDrive['en'], 'en')
                ->whereTranslation('name', $carTypeOfDrive['ru'], 'ru')
                ->first();

            if (!$carTypeOfDriveModel) {
                CarTypeOfDrive::create($carTypeOfDrive);
            }
        }
    }
}