<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'attribute_group_id' => 1,
            'tk' => [
                'name' => 'Kameralaryň sany',
            ],
            'en' => [
                'name' => 'Number of cameras',
            ],
            'ru' => [
                'name' => 'Количество камер',
            ],
        ]);
    }
}
