<?php

namespace Database\Seeders;

use App\Models\CarBody;
use Illuminate\Database\Seeder;

class CarBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carBodies = [
            [
                'tk' => ['name' => 'Sedan'],
                'en' => ['name' => 'Sedan'],
                'ru' => ['name' => 'Седан'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Ýeňil ulag'],
                'en' => ['name' => 'SUV'],
                'ru' => ['name' => 'Внедорожник'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Krossower'],
                'en' => ['name' => 'Crossover'],
                'ru' => ['name' => 'Кроссовер'],
                'is_active' => true
            ],
        ];

        foreach ($carBodies as $carBody) {
            $carBodyModel = CarBody::whereTranslation('name', $carBody['tk'], 'tk')
                ->whereTranslation('name', $carBody['en'], 'en')
                ->whereTranslation('name', $carBody['ru'], 'ru')
                ->first();

            if (!$carBodyModel) {
                CarBody::create($carBody);
            }
        }
    }
}
