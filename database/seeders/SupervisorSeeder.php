<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::firstOrCreate(
            ['email' => 'supervisor.yakyndar@gmail.com'],
            [
                'first_name' => 'Supervisor',
                'last_name' => 'Supervisor',
                'email_verified_at' => now(),
                'password' => Hash::make('supervisoryakyndar'),
            ]
        );

        $supervisor = Role::firstOrCreate([
            'guard_name' => 'admin',
            'name' => 'supervisor'
        ]);

        $admin->assignRole($supervisor);
    }
}
