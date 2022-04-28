<?php

namespace Database\Seeders;

use App\Models\CarColour;
use Illuminate\Database\Seeder;

class CarColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carColours = [
            [
                'tk' => ['name' => 'Ak'],
                'en' => ['name' => 'White'],
                'ru' => ['name' => 'Белый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Kümüş'],
                'en' => ['name' => 'Silver'],
                'ru' => ['name' => 'Серебристый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Gara'],
                'en' => ['name' => 'Black'],
                'ru' => ['name' => 'Черный'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Bej'],
                'en' => ['name' => 'Beige'],
                'ru' => ['name' => 'Бежевый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Klaret'],
                'en' => ['name' => 'Claret'],
                'ru' => ['name' => 'Бордовый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Bürünç'],
                'en' => ['name' => 'Bronze'],
                'ru' => ['name' => 'Бронзовый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Gök'],
                'en' => ['name' => 'Blue'],
                'ru' => ['name' => 'Голубой'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Sary'],
                'en' => ['name' => 'Yellow'],
                'ru' => ['name' => 'Желтый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Ýaşyl'],
                'en' => ['name' => 'Green'],
                'ru' => ['name' => 'Зеленый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Altyn'],
                'en' => ['name' => 'Gold'],
                'ru' => ['name' => 'Золотой'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Goňur'],
                'en' => ['name' => 'Brown'],
                'ru' => ['name' => 'Коричневый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Gyzyl'],
                'en' => ['name' => 'Red'],
                'ru' => ['name' => 'Красный'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Metal'],
                'en' => ['name' => 'Metallic'],
                'ru' => ['name' => 'Металлик'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Çygly asfalt'],
                'en' => ['name' => 'Wet asphalt'],
                'ru' => ['name' => 'Мокрый асфальт'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Mämişi'],
                'en' => ['name' => 'Orange'],
                'ru' => ['name' => 'Оранжевый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Çal'],
                'en' => ['name' => 'Gray'],
                'ru' => ['name' => 'Серый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Gök'],
                'en' => ['name' => 'Blue'],
                'ru' => ['name' => 'Синий'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Çerwi'],
                'en' => ['name' => 'Cherry'],
                'ru' => ['name' => 'Вишневый'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Açyk gök'],
                'en' => ['name' => 'Bright blue'],
                'ru' => ['name' => 'Ярко синий'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Deňiz gök'],
                'en' => ['name' => 'Navy blue'],
                'ru' => ['name' => 'Темно синий'],
                'is_active' => true
            ]
        ];

        foreach ($carColours as $carColour) {
            $carColourModel = CarColour::whereTranslation('name', $carColour['tk'], 'tk')
                ->whereTranslation('name', $carColour['en'], 'en')
                ->whereTranslation('name', $carColour['ru'], 'ru')
                ->first();

            if (!$carColourModel) {
                CarColour::create($carColour);
            }
        }
    }
}
