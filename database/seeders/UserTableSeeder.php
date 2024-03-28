<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert(
            [
                [
                    // Admin
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                    'password' => Hash::make('111'),
                    'status' => 'active',
                ],
                [
                    // Vendor
                    'name' => 'Richman Vendor',
                    'username' => 'vendor_richman',
                    'email' => 'vendor@gmail.com',
                    'role' => 'vendor',
                    'password' => Hash::make('111'),
                    'status' => 'active',
                ],
                [
                    // User Or Customer
                    'name' => 'User',
                    'username' => 'user',
                    'email' => 'user@email.com',
                    'role' => 'user',
                    'password' => Hash::make('111'),
                    'status' => 'active',
                ]

            ]
        );
    }
}
