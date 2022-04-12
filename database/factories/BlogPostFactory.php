<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blog_category_id' => BlogCategory::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(640, 480, 'business'),
            'status' => $this->faker->boolean(),
            'tk' => [
                'name' => $this->faker->sentence() . ' tk',
                'description' => $this->faker->text() . ' tk'
            ],
            'en' => [
                'name' => $this->faker->sentence() . ' en',
                'description' => $this->faker->text() . ' en'
            ],
            'ru' => [
                'name' => $this->faker->sentence() . ' ru',
                'description' => $this->faker->text() . ' tk'
            ],
        ];
    }
}
