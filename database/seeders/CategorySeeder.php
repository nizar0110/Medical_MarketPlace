<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([
            ['name' => 'Équipements de protection', 'description' => 'Masques, gants, blouses, etc.'],
            ['name' => 'Dispositifs médicaux', 'description' => 'Appareils et instruments médicaux.'],
            ['name' => 'Pharmaceutiques', 'description' => 'Médicaments et produits pharmaceutiques.'],
        ]);
    }
}
