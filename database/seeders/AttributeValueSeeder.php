<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeValue::create([
            'attribute_id' => 1,
            'tk' => [
                'name' => 'biri',
            ],
            'en' => [
                'name' => 'one',
            ],
            'ru' => [
                'name' => 'одна',
            ],
        ]);
    }
}
