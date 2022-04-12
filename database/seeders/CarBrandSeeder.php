<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use Illuminate\Database\Seeder;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carBrands = [
            'Toyota',
            'Lexus',
            'BMW',
            'Mercedes-Benz',
            'Hyundai',
            'Volkswagen',
            'Chevrolet',
            'Mazda',
            'Infiniti',
            'Nissan',
            'Kia',
            'Audi',
            'Jeep',
            'Ford',
            'Mitsubishi',
            'Chrysler',
            'Man',
            'Volvo',
            'Lada',
            'Opel',
            'Waz',
            'Dodge',
            'Honda',
            'Daf',
            'Peugeot',
            'Kamaz',
            'Citroen',
            'Zil',
            'Renault',
            'Daewoo',
            'Howo',
            'Uaz',
            'Ural',
            'Maz',
            'Iveco',
            'Gaz',
            'Kogel',
            'Scania',
            'Forland',
            'Chery',
            'Mtz',
            'Land Rover',
            'Golden Dragon',
            'Changan',
            'Jcb',
            'Xcmg',
            'Schmitz',
            'Fekon',
            'Tadano Faun',
            'Fiat',
            'Prisep',
            'Container',
            'Saipa',
            'Iž',
            'Saab',
            'Isuzu',
            'New Holland',
            'Yamaha',
            'Москвич',
            'Cmc',
            'Pontiac',
            'Kuba',
            'Tofaş',
            'Liugong',
            'Zaz',
            'Skoda',
            'Subaru',
            'Caterpillar',
            'Camc',
            'Zonda',
            'Ssangyong',
            'Lifan',
            'Buick',
            'Raf',
            'Alfa Romeo',
            'Byd',
            'Belarus',
            'Porsche',
            'Brilliance',
            'Daihatsu',
            'Roewe',
            'Mg',
            'Mini',
            'Suzuki',
            'Komatsu',
            'International',
            'Smart',
            'John',
            'Ppm',
            'Gmc',
            'Lincoln',
            'Jawa',
            'Geely',
            'Seat',
            'Jungheinrich',
            'Foton Lovol',
            'Case',
            'Foton',
            'Bomag',
            'Tesla',
            'Паз',
            'Dongfeng',
            'Balkancar'
        ];

        foreach ($carBrands as $carBrand) {
            CarBrand::firstOrCreate([
                'name' => $carBrand
            ], [
                'is_active' => true
            ]);
        }
    }
}
