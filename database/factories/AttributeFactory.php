<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeFactory extends Factory
{
    private static int $position = 1;

    protected $model = Attribute::class;

    public function definition(): array
    {
        return [
            'attribute_group_id' => AttributeGroup::factory(),
            'attribute_type'     => Product::class,
            'position'           => self::$position++,
            'name'               => [
                'en' => $this->faker->name(),
            ],
            'handle'        => Str::slug($this->faker->name()),
            'section'       => $this->faker->name(),
            'type'          => \GetCandy\FieldTypes\Text::class,
            'required'      => false,
            'default_value' => '',
            'configuration' => [
                'options' => [
                    $this->faker->name(),
                    $this->faker->name(),
                    $this->faker->name(),
                ],
            ],
            'system' => false,
        ];
    }
}
