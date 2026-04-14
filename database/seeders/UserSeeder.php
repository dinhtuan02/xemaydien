<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'phone' => '0900000001',
                'address' => 'Hà Nội',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Khách Hàng Demo',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'phone' => '0900000002',
                'address' => 'TP. Hồ Chí Minh',
                'is_active' => true,
            ]
        );
    }
}
