<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::insert([
            [
                'name' => 'Masque Chirurgical',
                'description' => 'Masque de protection à usage médical.',
                'price' => 8.00,
                'image' => null,
                'category_id' => 1,
                'seller_id' => 2,
                'stock' => 100,
            ],
            [
                'name' => 'Thermomètre Digital',
                'description' => 'Thermomètre médical précis.',
                'price' => 15.00,
                'image' => null,
                'category_id' => 2,
                'seller_id' => 2,
                'stock' => 50,
            ],
            [
                'name' => 'Paracétamol 500mg',
                'description' => 'Boîte de 16 comprimés.',
                'price' => 3.50,
                'image' => null,
                'category_id' => 3,
                'seller_id' => 2,
                'stock' => 200,
            ],
        ]);
    }
}
