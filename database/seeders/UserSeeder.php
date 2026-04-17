<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Siswa users
        User::updateOrCreate(
            ['username' => '2024001'],
            [
                'nama' => 'Siswa Test',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );

        User::updateOrCreate(
            ['username' => '2024002'],
            [
                'nama' => 'Ahmad Rizki',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );

        User::updateOrCreate(
            ['username' => '2024003'],
            [
                'nama' => 'Siti Nurhaliza',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );

        User::updateOrCreate(
            ['username' => '2024004'],
            [
                'nama' => 'Budi Santoso',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );

        User::updateOrCreate(
            ['username' => '2024005'],
            [
                'nama' => 'Dewi Lestari',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );
    }
}
