<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tk' => ['name' => $this->faker->name . ' tk'],
            'en' => ['name' => $this->faker->name . ' en'],
            'ru' => ['name' => $this->faker->name . ' ru'],
            'status' => $this->faker->boolean()
        ];
    }
}
