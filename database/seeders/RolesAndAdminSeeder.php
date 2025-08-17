<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles
        Role::firstOrCreate(['name' => 'patient', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Créer un admin de test
        $admin = User::firstOrCreate(
            ['email' => 'admin@rvmedical.com'],
            [
                'name' => 'Admin Test',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole('admin');
        }
}
