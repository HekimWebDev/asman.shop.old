<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $mainGroup = AttributeGroup::create([
            'attributable_type' => ProductType::class,
            'name'              => collect([
                'ru' => 'Основной',
                'tm' => 'Esasy'
            ]),
            'position' => 1,
        ]);

        $secondaryGroup = AttributeGroup::create([
            'attributable_type' => ProductType::class,
            'name'              => collect([
                'ru' => 'Описание',
                'tm' => 'Maglumatlar'
            ]),
            'position' => 1,
        ]);

        // Attributes
        Attribute::create([
            'attribute_type'     => ProductType::class,
            'attribute_group_id' => $mainGroup->id,
            'position'           => 1,
            'name'               => [
                'ru' => 'Наименование',
                'tm' => 'Ady'
            ],
            'handle'        => 'name',
            'section'       => 'main',
            'type'          => TranslatedText::class,
            'required'      => true,
            'default_value' => null,
            'configuration' => [
                'type' => 'text',
            ],
            'system' => true,
        ]);

        Attribute::create([
            'attribute_type'     => ProductType::class,
            'attribute_group_id' => $mainGroup->id,
            'position'           => 2,
            'name'               => [
                'en' => 'Short name',
                'ru' => 'Короткое название',
                'tm' => 'Gysga ady'
            ],
            'handle'        => 'short-name',
            'section'       => 'main',
            'type'          => TranslatedText::class,
            'required'      => true,
            'default_value' => null,
            'configuration' => [
                'type' => 'text',
            ],
            'system' => true,
        ]);

        Attribute::create([
            'attribute_type'     => ProductType::class,
            'attribute_group_id' => $mainGroup->id,
            'position'           => 3,
            'name'               => [
                'ru' => 'Короткое описание',
                'tm' => 'Gysga maglumaty'
            ],
            'handle'        => 'short-description',
            'section'       => 'main',
            'type'          => TranslatedText::class,
            'required'      => true,
            'default_value' => null,
            'configuration' => [
                'type' => 'text',
            ],
            'system' => true,
        ]);

        Attribute::create([
            'attribute_type'     => ProductType::class,
            'attribute_group_id' => $mainGroup->id,
            'position'           => 4,
            'name'               => [
                'ru' => 'Описание',
                'tm' => 'Maglumaty'
            ],
            'handle'        => 'details',
            'section'       => 'main',
            'type'          => TranslatedText::class,
            'required'      => true,
            'default_value' => null,
            'configuration' => [
                'type' => 'richtext',
            ],
            'system' => true,
        ]);

        // Attribute::create([
        //     'attribute_type'     => ProductType::class,
        //     'attribute_group_id' => $secondaryGroup->id,
        //     'position'           => 2,
        //     'name'               => [
        //         'ru' => 'Ингредиенты и аллергены',
        //         'tm' => 'Goşundylar we allergenler'
        //     ],
        //     'handle'        => 'ingredients',
        //     'section'       => 'main',
        //     'type'          => TranslatedText::class,
        //     'required'      => true,
        //     'default_value' => null,
        //     'configuration' => [
        //         'type' => 'richtext',
        //     ],
        //     'system' => false,
        // ]);

        // Attribute::create([
        //     'attribute_type'     => ProductType::class,
        //     'attribute_group_id' => $secondaryGroup->id,
        //     'position'           => 2,
        //     'name'               => [
        //         'ru' => 'Питательные свойства',
        //         'tm' => 'iýmitleniş aýratynlyklary'
        //     ],
        //     'handle'        => 'nutritional-data',
        //     'section'       => 'main',
        //     'type'          => TranslatedText::class,
        //     'required'      => true,
        //     'default_value' => null,
        //     'configuration' => [
        //         'type' => 'richtext',
        //     ],
        //     'system' => false,
        // ]);

        // Attribute::create([
        //     'attribute_type'     => ProductType::class,
        //     'attribute_group_id' => $secondaryGroup->id,
        //     'position'           => 2,
        //     'name'               => [
        //         'ru' => 'Cпособ приготовление и храние',
        //         'tm' => 'Taýýarlak we saklanyş usuly',
        //     ],
        //     'handle'        => 'preparation',
        //     'section'       => 'main',
        //     'type'          => TranslatedText::class,
        //     'required'      => true,
        //     'default_value' => null,
        //     'configuration' => [
        //         'type' => 'richtext',
        //     ],
        //     'system' => false,
        // ]);

        // Attribute::create([
        //     'attribute_type'     => ProductType::class,
        //     'attribute_group_id' => $secondaryGroup->id,
        //     'position'           => 2,
        //     'name'               => [
        //         'ru' => 'Дополнительная информация',
        //         'tm' => 'Goşmaça maglumat',
        //     ],
        //     'handle'        => 'add-info',
        //     'section'       => 'main',
        //     'type'          => TranslatedText::class,
        //     'required'      => true,
        //     'default_value' => null,
        //     'configuration' => [
        //         'type' => 'richtext',
        //     ],
        //     'system' => false,
        // ]);
    }
}
