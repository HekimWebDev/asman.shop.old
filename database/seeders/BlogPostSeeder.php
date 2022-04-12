<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\BlogPost::factory(10)->create();
    }
}
