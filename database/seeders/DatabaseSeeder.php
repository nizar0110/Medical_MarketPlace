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

        // Créer des utilisateurs ERP avec rôles étendus
        $warehouseManager = User::create([
            'name' => 'Gestionnaire Entrepôt',
            'email' => 'warehouse@medical.com',
            'password' => bcrypt('password'),
            'role' => 'warehouse_manager'
        ]);



        $buyer = User::create([
            'name' => 'Acheteur',
            'email' => 'buyer@medical.com',
            'password' => bcrypt('password'),
            'role' => 'buyer'
        ]);

        $salesManager = User::create([
            'name' => 'Responsable Commercial',
            'email' => 'sales@medical.com',
            'password' => bcrypt('password'),
            'role' => 'sales_manager'
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
            // Catégorie 1: Équipements de diagnostic
            [
                'name' => 'Stéthoscope Littmann Classic III',
                'description' => 'Stéthoscope professionnel de haute qualité pour auscultation cardiaque et pulmonaire.',
                'price' => 899.99,
                'category_id' => 1,
                'stock' => 50,
                'seller_id' => $seller->id,
                'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
            ],
            [
                'name' => 'Tensiomètre automatique Omron',
                'description' => 'Tensiomètre électronique automatique avec brassard ajustable et mémoire de 60 mesures.',
                'price' => 455.50,
                'category_id' => 1,
                'stock' => 30,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Thermomètre infrarouge frontal',
                'description' => 'Thermomètre sans contact pour mesure rapide de la température corporelle.',
                'price' => 89.99,
                'category_id' => 1,
                'stock' => 100,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Oxymètre de pouls portable',
                'description' => 'Oxymètre de pouls digital avec affichage LED et alarmes sonores.',
                'price' => 125.00,
                'category_id' => 1,
                'stock' => 75,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Otoscope LED professionnel',
                'description' => 'Otoscope avec éclairage LED pour examen des oreilles et du nez.',
                'price' => 299.99,
                'category_id' => 1,
                'stock' => 25,
                'seller_id' => $seller->id
            ],

            // Catégorie 2: Instruments chirurgicaux
            [
                'name' => 'Scalpel chirurgical #10',
                'description' => 'Scalpel stérile avec lame interchangeable pour interventions chirurgicales.',
                'price' => 129.99,
                'category_id' => 2,
                'stock' => 200,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Ciseaux chirurgicaux Mayo',
                'description' => 'Ciseaux chirurgicaux en acier inoxydable pour dissection des tissus.',
                'price' => 189.99,
                'category_id' => 2,
                'stock' => 80,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Pince hémostatique Kelly',
                'description' => 'Pince hémostatique courbe pour clampage des vaisseaux sanguins.',
                'price' => 145.50,
                'category_id' => 2,
                'stock' => 120,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Écarteurs chirurgicaux',
                'description' => 'Écarteurs en acier inoxydable pour maintenir l\'ouverture des incisions.',
                'price' => 299.99,
                'category_id' => 2,
                'stock' => 45,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Bistouri électrique',
                'description' => 'Bistouri électrique avec contrôle de puissance pour chirurgie précise.',
                'price' => 2500.00,
                'category_id' => 2,
                'stock' => 15,
                'seller_id' => $seller->id
            ],

            // Catégorie 3: Mobilier médical
            [
                'name' => 'Lit médical électrique',
                'description' => 'Lit médical électrique avec commandes motorisées et matelas anti-escarres.',
                'price' => 25000.00,
                'category_id' => 3,
                'stock' => 10,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Fauteuil roulant standard',
                'description' => 'Fauteuil roulant pliable avec accoudoirs et repose-pieds amovibles.',
                'price' => 899.99,
                'category_id' => 3,
                'stock' => 35,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Table d\'examen médical',
                'description' => 'Table d\'examen avec revêtement vinyle et hauteur ajustable.',
                'price' => 1200.00,
                'category_id' => 3,
                'stock' => 20,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Chariot de soins mobile',
                'description' => 'Chariot de soins avec tiroirs organisateurs et roues pivotantes.',
                'price' => 650.00,
                'category_id' => 3,
                'stock' => 40,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Moniteur de surveillance',
                'description' => 'Moniteur multiparamètres pour surveillance des signes vitaux.',
                'price' => 3500.00,
                'category_id' => 3,
                'stock' => 18,
                'seller_id' => $seller->id
            ],

            // Catégorie 4: Consommables
            [
                'name' => 'Gants latex taille M',
                'description' => 'Boîte de 100 gants latex stériles, taille moyenne.',
                'price' => 159.99,
                'category_id' => 4,
                'stock' => 500,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Seringues 10ml avec aiguilles',
                'description' => 'Seringues stériles 10ml avec aiguilles 21G, boîte de 100.',
                'price' => 89.99,
                'category_id' => 4,
                'stock' => 300,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Compresses stériles 10x10cm',
                'description' => 'Compresses de gaze stériles, boîte de 200 unités.',
                'price' => 75.50,
                'category_id' => 4,
                'stock' => 400,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Pansements adhésifs',
                'description' => 'Pansements adhésifs hypoallergéniques, boîte de 100.',
                'price' => 45.99,
                'category_id' => 4,
                'stock' => 600,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Masques chirurgicaux FFP2',
                'description' => 'Masques de protection FFP2, boîte de 50 unités.',
                'price' => 120.00,
                'category_id' => 4,
                'stock' => 250,
                'seller_id' => $seller->id
            ],

            // Catégorie 5: Technologies médicales
            [
                'name' => 'Échographe portable',
                'description' => 'Échographe portable haute résolution avec sonde multi-fréquences.',
                'price' => 85000.00,
                'category_id' => 5,
                'stock' => 5,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Défibrillateur automatique',
                'description' => 'Défibrillateur automatique externe avec instructions vocales.',
                'price' => 15000.00,
                'category_id' => 5,
                'stock' => 12,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Ventilateur mécanique',
                'description' => 'Ventilateur mécanique portable pour assistance respiratoire.',
                'price' => 45000.00,
                'category_id' => 5,
                'stock' => 8,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Pompe à perfusion',
                'description' => 'Pompe à perfusion volumétrique avec contrôle de débit précis.',
                'price' => 2800.00,
                'category_id' => 5,
                'stock' => 25,
                'seller_id' => $seller->id
            ],
            [
                'name' => 'Analyseur de laboratoire',
                'description' => 'Analyseur automatique pour tests sanguins et urinaires.',
                'price' => 65000.00,
                'category_id' => 5,
                'stock' => 6,
                'seller_id' => $seller->id
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Exécuter les seeders ERP
        $this->call([
            ERPInventorySeeder::class,
            ERPMarocSeeder::class,
        ]);

        // Exécuter le seeder des catégories de la page d'accueil
        $this->call([
            HomePageCategoriesSeeder::class,
        ]);
    }
}
