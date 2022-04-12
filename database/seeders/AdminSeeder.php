<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'Adminov',
            'email' => 'admin.yakyndar@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminyakyndar'),
            'remember_token' => Str::random(10),
        ]);
    }
}
