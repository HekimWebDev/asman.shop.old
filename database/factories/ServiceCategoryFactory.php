<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(640, 480, 'business'),
            'status' => $this->faker->boolean(),
            'tk' => ['name' => $this->faker->sentence() . ' tk'],
            'en' => ['name' => $this->faker->sentence() . ' en'],
            'ru' => ['name' => $this->faker->sentence() . ' ru']
        ];
    }
}