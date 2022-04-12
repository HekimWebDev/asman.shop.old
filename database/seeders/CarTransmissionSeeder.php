<?php

namespace Database\Seeders;

use App\Models\CarTransmission;
use Illuminate\Database\Seeder;

class CarTransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carTransmissions = [
            [
                'tk' => ['name' => 'RWD - Yzky tigir'],
                'en' => ['name' => 'RWD - Rear wheel drive'],
                'ru' => ['name' => 'РВД - Задний привод'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'FWD - Öňki tigir'],
                'en' => ['name' => 'FVD - Front wheel drive'],
                'ru' => ['name' => 'ФВД - Передний привод'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => '4VD - Dört tigirli'],
                'en' => ['name' => '4VD - All wheel drive'],
                'ru' => ['name' => '4ВД - Полный привод'],
                'is_active' => true
            ],
        ];

        foreach ($carTransmissions as $carTransmission) {
            $carTransmissionModel = CarTransmission::whereTranslation('name', $carTransmission['tk'], 'tk')
                ->whereTranslation('name', $carTransmission['en'], 'en')
                ->whereTranslation('name', $carTransmission['ru'], 'ru')
                ->first();

            if (!$carTransmissionModel) {
                CarTransmission::create($carTransmission);
            }
        }
    }
}