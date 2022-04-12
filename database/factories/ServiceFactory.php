<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_category_id' => \App\Models\ServiceCategory::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(640, 480, 'business'),
            'status' => $this->faker->boolean(),
            'phone' => $this->faker->numberBetween(61000000, 65999999),
            'email' => $this->faker->email(),
            'tk' => [
                'owner' => $this->faker->name(),
                'address' => $this->faker->address(),
                'name' => $this->faker->sentence() . ' tk',
                'description' => $this->faker->text() . ' tk'
            ],
            'en' => [
                'owner' => $this->faker->name(),
                'address' => $this->faker->address(),
                'name' => $this->faker->sentence() . ' en',
                'description' => $this->faker->text() . ' en'
            ],
            'ru' => [
                'owner' => $this->faker->name(),
                'address' => $this->faker->address(),
                'name' => $this->faker->sentence() . ' ru',
                'description' => $this->faker->text() . ' tk'
            ],
        ];
    }
}
