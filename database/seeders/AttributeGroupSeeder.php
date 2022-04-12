<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use Illuminate\Database\Seeder;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeGroup::create([
            'tk' => [
                'name' => 'DVD kamerasy',
            ],
            'en' => [
                'name' => 'DVR camera',
            ],
            'ru' => [
                'name' => 'Камера видеорегистратора',
            ],
        ]);
    }
}
