<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@medmarket.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Vendeur Médical',
                'email' => 'vendeur@medmarket.com',
                'password' => bcrypt('password'),
                'role' => 'seller',
            ],
            [
                'name' => 'Client Test',
                'email' => 'client@medmarket.com',
                'password' => bcrypt('password'),
                'role' => 'client',
            ],
        ]);
    }
}
