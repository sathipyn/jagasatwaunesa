<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'nama_lengkap' => 'Super Admin JagaSatwa',
            'email' => 'admin@jagasatwa.com',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super_admin');

        // Admin Rescue (Divisi RnT)
        $adminRescue = User::create([
            'nama_lengkap' => 'Admin Rescue',
            'email' => 'rescue@jagasatwa.com',
            'username' => 'adminrescue',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $adminRescue->assignRole('admin_rescue');

        // Admin Donasi (Bendahara)
        $adminDonasi = User::create([
            'nama_lengkap' => 'Admin Donasi',
            'email' => 'donasi@jagasatwa.com',
            'username' => 'admindonasi',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $adminDonasi->assignRole('admin_donasi');

        // User biasa (untuk testing)
        $userTest = User::create([
            'nama_lengkap' => 'User Test',
            'email' => 'user@test.com',
            'username' => 'usertest',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $userTest->assignRole('user');

        $this->command->info('Users created successfully!');
        $this->command->info('  - admin@jagasatwa.com  (super_admin)');
        $this->command->info('  - rescue@jagasatwa.com (admin_rescue)');
        $this->command->info('  - donasi@jagasatwa.com (admin_donasi)');
        $this->command->info('  - user@test.com        (user)');

        $this->command->info('Users created successfully!');
    }
}