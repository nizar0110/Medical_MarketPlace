<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@medical.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Créer un utilisateur vendeur
        $seller = User::create([
            'name' => 'Vendeur Test',
            'email' => 'vendeur@medical.com',
            'password' => bcrypt('password'),
            'role' => 'seller'
        ]);

        // Créer un utilisateur client
        $client = User::create([
            'name' => 'Client Test',
            'email' => 'client@medical.com',
            'password' => bcrypt('password'),
            'role' => 'client'
        ]);

        // Créer des catégories
        $categories = [
            ['name' => 'Équipements de diagnostic'],
            ['name' => 'Instruments chirurgicaux'],
            ['name' => 'Mobilier médical'],
            ['name' => 'Consommables'],
            ['name' => 'Technologies médicales']
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Créer des produits (assignés au vendeur)
        $products = [
            [
                'name' => 'Stéthoscope Littmann Classic III',
                'description' => 'Stéthoscope professionnel de haute qualité pour auscultation cardiaque et pulmonaire.',
                'price' => 899.99,
                'category_id' => 1,
                'stock' => 50,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Tensiomètre automatique',
                'description' => 'Tensiomètre électronique automatique avec brassard ajustable.',
                'price' => 455.50,
                'category_id' => 1,
                'stock' => 30,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Scalpel chirurgical',
                'description' => 'Scalpel stérile avec lame interchangeable pour interventions chirurgicales.',
                'price' => 129.99,
                'category_id' => 2,
                'stock' => 200,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Lit médical électrique',
                'description' => 'Lit médical électrique avec commandes motorisées et matelas anti-escarres.',
                'price' => 25000.00,
                'category_id' => 3,
                'stock' => 10,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Gants latex taille M',
                'description' => 'Boîte de 100 gants latex stériles, taille moyenne.',
                'price' => 159.99,
                'category_id' => 4,
                'stock' => 500,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Échographe portable',
                'description' => 'Échographe portable haute résolution avec sonde multi-fréquences.',
                'price' => 85000.00,
                'category_id' => 5,
                'stock' => 5,
                'seller_id' => $seller->id
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
