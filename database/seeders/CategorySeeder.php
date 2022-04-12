<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) {
            Category::create([
                'parent_id' => null,
                'order' => 0,
                'image' => null,
                'status' => 0,
                'tk' => [
                    'slug' => Str::slug('Category tk-' . $i),
                    'name' => 'Category tk-' . $i,
                    'description' => 'Description category tk-' . $i,
                ],
                'en' => [
                    'slug' => Str::slug('Category en-' . $i),
                    'name' => 'Category en-' . $i,
                    'description' => 'Description category en-' . $i,
                ],
                'ru' => [
                    'slug' => Str::slug('Category ru-' . $i),
                    'name' => 'Category ru-' . $i,
                    'description' => 'Description category ru-' . $i,
                ],
            ]);
        }
    }
}
