<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            // UserSeeder::class,
            // CategorySeeder::class,
            // AttributeGroupSeeder::class,
            // AttributeSeeder::class,
            // AttributeValueSeeder::class,
            LogoSeeder::class,
            // BlogCategorySeeder::class,
            // BannerSeeder::class,
            CarBrandSeeder::class,
            CarBodySeeder::class,
            CarColourSeeder::class,
            CarModelSeeder::class,
            CarPlaceSeeder::class,
            CarTransmissionSeeder::class,
            CarTypeOfDriveSeeder::class,
        ]);
    }
}
