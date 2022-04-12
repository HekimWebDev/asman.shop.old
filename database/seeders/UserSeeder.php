<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Atageldi',
            'last_name' => 'Didarov',
            'phone' => '63952599',
            'address' => 'Gokdepe, Yangala',
            'email' => 'didarov.atageldi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('atageldi2015'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'first_name' => 'Baygeldi',
            'last_name' => 'Cholukov',
            'phone' => '62726535',
            'address' => 'Murgap, Mary',
            'email' => 'baygeldicholukov@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('baygeldi2001'),
            'remember_token' => Str::random(10),
        ]);

        $user->company()->create([
            'name' => 'Bayco',
            'website' => 'bayco.com.tm',
            'tin' => 'A1B2C3',
            'fax_address' => 'Ashgabat',
            'about' => 'About Bayco company'
        ]);
    }
}
