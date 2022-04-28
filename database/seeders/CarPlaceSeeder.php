<?php

namespace Database\Seeders;

use App\Models\CarPlace;
use Illuminate\Database\Seeder;

class CarPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carPlaces = [
            [
                'tk' => ['name' => 'Aşgabat'],
                'en' => ['name' => 'Ashgabat'],
                'ru' => ['name' => 'Ашхабад'],
                'is_active' => true
            ],
            [
                'tk' => ['name' => 'Ahal welaýat'],
                'en' => ['name' => 'Akhal province'],
                'ru' => ['name' => 'Ахалский велаят'],
                'is_active' => true,
                'children' => [
                    [
                        'tk' => ['name' => 'Ýaşlyk'],
                        'en' => ['name' => 'Yashlyk'],
                        'ru' => ['name' => 'Яшлык'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Ak-Bugdaý'],
                        'en' => ['name' => 'Ak-Bugday'],
                        'ru' => ['name' => 'Ак-Бугдай'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Bäherde'],
                        'en' => ['name' => 'Baharden'],
                        'ru' => ['name' => 'Бахарден'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Babadaýhan'],
                        'en' => ['name' => 'Babadaykhan'],
                        'ru' => ['name' => 'Бабадайхан'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Gökdepe'],
                        'en' => ['name' => 'Gokdepe'],
                        'ru' => ['name' => 'Гёкдепе'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Kaka'],
                        'en' => ['name' => 'Kaka'],
                        'ru' => ['name' => 'Кака'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Änew'],
                        'en' => ['name' => 'Anev'],
                        'ru' => ['name' => 'Анев'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Tejen'],
                        'en' => ['name' => 'Tejen'],
                        'ru' => ['name' => 'Теджен'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Sarahs'],
                        'en' => ['name' => 'Sarakhs'],
                        'ru' => ['name' => 'Сарахс'],
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'tk' => ['name' => 'Balkan welaýat'],
                'en' => ['name' => 'Balkan province'],
                'ru' => ['name' => 'Балканский велаят'],
                'is_active' => true,
                'children' => [
                    [
                        'tk' => ['name' => 'Magtymguly'],
                        'en' => ['name' => 'Makhtumkuli'],
                        'ru' => ['name' => 'Махтумкули'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Bereket'],
                        'en' => ['name' => 'Bereket'],
                        'ru' => ['name' => 'Берекет'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Etrek'],
                        'en' => ['name' => 'Etrek'],
                        'ru' => ['name' => 'Этрек'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Esenguly'],
                        'en' => ['name' => 'Esenguly'],
                        'ru' => ['name' => 'Эсенгулы'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Gumdag'],
                        'en' => ['name' => 'Gumdag'],
                        'ru' => ['name' => 'Гумдаг'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Balkanabat'],
                        'en' => ['name' => 'Balkanabat'],
                        'ru' => ['name' => 'Балканабат'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Garabogaz'],
                        'en' => ['name' => 'Karabogaz'],
                        'ru' => ['name' => 'Карабогаз'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Hazar'],
                        'en' => ['name' => 'Khazar'],
                        'ru' => ['name' => 'Хазар'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Serdar'],
                        'en' => ['name' => 'Serdar'],
                        'ru' => ['name' => 'Сердар'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Türkmenbaşy'],
                        'en' => ['name' => 'Turkmenbashi'],
                        'ru' => ['name' => 'Туркменбаши'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Jebel'],
                        'en' => ['name' => 'Jebel'],
                        'ru' => ['name' => 'Джебел'],
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'tk' => ['name' => 'Mary welaýat'],
                'en' => ['name' => 'Mary province'],
                'ru' => ['name' => 'Марыйский велаят'],
                'is_active' => true,
                'children' => [
                    [
                        'tk' => ['name' => 'Ýolöten'],
                        'en' => ['name' => 'Yoleten'],
                        'ru' => ['name' => 'Ёлётен'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Mary'],
                        'en' => ['name' => 'Mary'],
                        'ru' => ['name' => 'Мары'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Murgap'],
                        'en' => ['name' => 'Murgap'],
                        'ru' => ['name' => 'Мургап'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Sakarçäge'],
                        'en' => ['name' => 'Sakarchaga'],
                        'ru' => ['name' => 'Сакарчага'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Serhetabat (Guşgy)'],
                        'en' => ['name' => 'Serhetabat (Kushka)'],
                        'ru' => ['name' => 'Серхетабат (Кушка)'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Tagtabazar'],
                        'en' => ['name' => 'Tagtabazar'],
                        'ru' => ['name' => 'Тагтабазар'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Türkmengala'],
                        'en' => ['name' => 'Turkmengala'],
                        'ru' => ['name' => 'Туркменгала'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Oguz han'],
                        'en' => ['name' => 'Oguz khan'],
                        'ru' => ['name' => 'Огуз хан'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Bayramaly'],
                        'en' => ['name' => 'Bayramali'],
                        'ru' => ['name' => 'Байрамали'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Şatlyk'],
                        'en' => ['name' => 'Shatlyk'],
                        'ru' => ['name' => 'Шатлык'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Wekilbazar'],
                        'en' => ['name' => 'Vekilbazar'],
                        'ru' => ['name' => 'Векильбазар'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Garagum'],
                        'en' => ['name' => 'Karakum'],
                        'ru' => ['name' => 'Каракум'],
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'tk' => ['name' => 'Lebap welaýat'],
                'en' => ['name' => 'Lebap province'],
                'ru' => ['name' => 'Лебапский велаят'],
                'is_active' => true,
                'children' => [
                    [
                        'tk' => ['name' => 'Darganata'],
                        'en' => ['name' => 'Darganata'],
                        'ru' => ['name' => 'Дарганата'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Farap'],
                        'en' => ['name' => 'Farap'],
                        'ru' => ['name' => 'Фарап'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Gazojak'],
                        'en' => ['name' => 'Gazodzhak'],
                        'ru' => ['name' => 'Газоджак'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Dänew'],
                        'en' => ['name' => 'Dyanev'],
                        'ru' => ['name' => 'Дянев'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Garabekewül'],
                        'en' => ['name' => 'Garabekevul'],
                        'ru' => ['name' => 'Гарабекевюл'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Türkmenabat'],
                        'en' => ['name' => 'Turkmenabat'],
                        'ru' => ['name' => 'Туркменабат'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Dostluk'],
                        'en' => ['name' => 'Dostluk'],
                        'ru' => ['name' => 'Достлук'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Hojambaz'],
                        'en' => ['name' => 'Khojambaz'],
                        'ru' => ['name' => 'Ходжамбаз'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Köýtendag'],
                        'en' => ['name' => 'Koytendag'],
                        'ru' => ['name' => 'Койтендаг'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Magdanly'],
                        'en' => ['name' => 'Magdanly'],
                        'ru' => ['name' => 'Магданлы'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Sakar'],
                        'en' => ['name' => 'Sakar'],
                        'ru' => ['name' => 'Сакар'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Saýat'],
                        'en' => ['name' => 'Sayat'],
                        'ru' => ['name' => 'Саят'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Seýdi'],
                        'en' => ['name' => 'Seydi'],
                        'ru' => ['name' => 'Сейди'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Çärjew'],
                        'en' => ['name' => 'Chardzhou'],
                        'ru' => ['name' => 'Чарджоу'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Halaç'],
                        'en' => ['name' => 'Halach'],
                        'ru' => ['name' => 'Халач'],
                        'is_active' => true,
                    ]
                ]
            ],
            [
                'tk' => ['name' => 'Daşoguz welaýat'],
                'en' => ['name' => 'Dashoguz province'],
                'ru' => ['name' => 'Дашогузский велаят'],
                'is_active' => true,
                'children' => [
                    [
                        'tk' => ['name' => 'Akdepe'],
                        'en' => ['name' => 'Akdepe'],
                        'ru' => ['name' => 'Акдепе'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Gurbansoltan eje'],
                        'en' => ['name' => 'Gurbansoltan edzhe'],
                        'ru' => ['name' => 'Гурбансолтан эдже'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Boldumsaz'],
                        'en' => ['name' => 'Boldumsaz'],
                        'ru' => ['name' => 'Болдумсаз'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Daşoguz'],
                        'en' => ['name' => 'Dashoguz'],
                        'ru' => ['name' => 'Дашогуз'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Gubadag'],
                        'en' => ['name' => 'Gubadag'],
                        'ru' => ['name' => 'Губадаг'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Görogly (Tagta)'],
                        'en' => ['name' => 'Gorogly (Tagta)'],
                        'ru' => ['name' => 'Гороглы (Тагта)'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Türkmenbaşy'],
                        'en' => ['name' => 'Turkmenbashi'],
                        'ru' => ['name' => 'Туркменбаши'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Ruhubelent'],
                        'en' => ['name' => 'Ruhubelent'],
                        'ru' => ['name' => 'Рухубелент'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'Köneürgenç'],
                        'en' => ['name' => 'Koeneurgench'],
                        'ru' => ['name' => 'Кёнеургенч'],
                        'is_active' => true,
                    ],
                    [
                        'tk' => ['name' => 'S.A.Nyýazow'],
                        'en' => ['name' => 'S.A.Niyazov'],
                        'ru' => ['name' => 'С.А.Ниязов'],
                        'is_active' => true,
                    ]
                ]
            ]
        ];

        foreach ($carPlaces as $carPlace) {
            $carPlaceModel = CarPlace::whereTranslation('name', $carPlace['tk'], 'tk')
                ->whereTranslation('name', $carPlace['en'], 'en')
                ->whereTranslation('name', $carPlace['ru'], 'ru')
                ->first();

            if (!$carPlaceModel) {
                $carPlaceModel = CarPlace::create($carPlace);
            }

            if (array_key_exists('children', $carPlace)) {
                foreach ($carPlace['children'] as $child) {
                    $childModel = $carPlaceModel->children()
                        ->whereTranslation('name', $child['tk'], 'tk')
                        ->whereTranslation('name', $child['en'], 'en')
                        ->whereTranslation('name', $child['ru'], 'ru')
                        ->first();

                    if (!$childModel) {
                        $carPlaceModel->children()->create($child);
                    }
                }
            }
        }
    }
}
