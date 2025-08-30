<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class HomePageCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer le vendeur existant
        $seller = User::where('role', 'seller')->first();
        
        if (!$seller) {
            $this->command->error('Aucun vendeur trouvé. Créez d\'abord un vendeur.');
            return;
        }

        // Créer les nouvelles catégories de la page d'accueil
        $categories = [
            [
                'name' => 'Cardiologie',
                'description' => 'Équipements et dispositifs pour la santé cardiovasculaire'
            ],
            [
                'name' => 'Neurologie',
                'description' => 'Instruments et dispositifs pour la neurologie'
            ],
            [
                'name' => 'Ophtalmologie',
                'description' => 'Équipements pour la santé oculaire'
            ],
            [
                'name' => 'Orthopédie',
                'description' => 'Dispositifs et équipements orthopédiques'
            ],
            [
                'name' => 'Diagnostic',
                'description' => 'Instruments de diagnostic et de mesure'
            ],
            [
                'name' => 'Médicaments',
                'description' => 'Produits pharmaceutiques et médicaments'
            ]
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description']
            ]);

            // Créer des produits pour chaque catégorie
            $this->createProductsForCategory($category, $seller);
        }
    }

    /**
     * Créer des produits spécifiques pour chaque catégorie
     */
    private function createProductsForCategory($category, $seller)
    {
        $products = [];

        switch ($category->name) {
            case 'Cardiologie':
                $products = [
                    [
                        'name' => 'Électrocardiographe portable',
                        'description' => 'ECG portable 12 dérivations avec analyse automatique et transmission Bluetooth.',
                        'price' => 3500.00,
                        'stock' => 15,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Défibrillateur semi-automatique',
                        'description' => 'Défibrillateur avec analyse ECG et choc guidé par ordinateur.',
                        'price' => 12000.00,
                        'stock' => 8,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Holter ECG 24h',
                        'description' => 'Enregistreur ECG portable pour surveillance continue sur 24h.',
                        'price' => 1800.00,
                        'stock' => 25,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Tensiomètre ambulatoire',
                        'description' => 'Tensiomètre portable pour mesure automatique sur 24h.',
                        'price' => 850.00,
                        'stock' => 30,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ]
                ];
                break;

            case 'Neurologie':
                $products = [
                    [
                        'name' => 'Électroencéphalographe',
                        'description' => 'EEG 32 canaux avec analyse des ondes cérébrales.',
                        'price' => 25000.00,
                        'stock' => 5,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Stimulateur cérébral',
                        'description' => 'Stimulateur transcrânien pour traitement de la dépression.',
                        'price' => 8500.00,
                        'stock' => 12,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Moniteur de pression intracrânienne',
                        'description' => 'Capteur de pression pour surveillance neurologique.',
                        'price' => 3200.00,
                        'stock' => 18,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Électromyographe',
                        'description' => 'Appareil de mesure de l\'activité musculaire.',
                        'price' => 4200.00,
                        'stock' => 15,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ]
                ];
                break;

            case 'Ophtalmologie':
                $products = [
                    [
                        'name' => 'Tonomètre à aplanation',
                        'description' => 'Mesureur de pression intraoculaire de précision.',
                        'price' => 2800.00,
                        'stock' => 20,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Ophtalmoscope direct',
                        'description' => 'Ophtalmoscope LED pour examen du fond d\'œil.',
                        'price' => 450.00,
                        'stock' => 35,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Lampe à fente',
                        'description' => 'Microscope pour examen détaillé des structures oculaires.',
                        'price' => 3800.00,
                        'stock' => 12,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Autoréfractomètre',
                        'description' => 'Mesure automatique de la réfraction oculaire.',
                        'price' => 15000.00,
                        'stock' => 8,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ]
                ];
                break;

            case 'Orthopédie':
                $products = [
                    [
                        'name' => 'Attelle de poignet',
                        'description' => 'Attelle orthopédique ajustable pour immobilisation.',
                        'price' => 89.99,
                        'stock' => 100,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Orthèse lombaire',
                        'description' => 'Corset lombaire pour soutien et stabilisation.',
                        'price' => 250.00,
                        'stock' => 60,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Prothèse de genou',
                        'description' => 'Prothèse articulée avec système de verrouillage.',
                        'price' => 8500.00,
                        'stock' => 15,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Béquilles ajustables',
                        'description' => 'Béquilles en aluminium avec hauteur réglable.',
                        'price' => 120.00,
                        'stock' => 80,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ]
                ];
                break;

            case 'Diagnostic':
                $products = [
                    [
                        'name' => 'Stéthoscope Littmann Classic III',
                        'description' => 'Stéthoscope professionnel pour auscultation cardiaque et pulmonaire.',
                        'price' => 899.99,
                        'stock' => 50,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Tensiomètre automatique Omron',
                        'description' => 'Tensiomètre électronique avec mémoire et brassard ajustable.',
                        'price' => 455.50,
                        'stock' => 30,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Thermomètre infrarouge',
                        'description' => 'Thermomètre sans contact pour mesure rapide.',
                        'price' => 89.99,
                        'stock' => 100,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Oxymètre de pouls',
                        'description' => 'Mesureur de saturation en oxygène et fréquence cardiaque.',
                        'price' => 125.00,
                        'stock' => 75,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ]
                ];
                break;

            case 'Médicaments':
                $products = [
                    [
                        'name' => 'Paracétamol 500mg',
                        'description' => 'Antidouleur et antipyrétique, boîte de 20 comprimés.',
                        'price' => 8.99,
                        'stock' => 500,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Ibuprofène 400mg',
                        'description' => 'Anti-inflammatoire non stéroïdien, boîte de 30 comprimés.',
                        'price' => 12.50,
                        'stock' => 400,
                        'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Vitamine D3 1000UI',
                        'description' => 'Complément vitaminique pour la santé osseuse, 60 gélules.',
                        'price' => 18.99,
                        'stock' => 300,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ],
                    [
                        'name' => 'Oméprazole 20mg',
                        'description' => 'Protecteur gastrique, boîte de 28 gélules.',
                        'price' => 25.00,
                        'stock' => 200,
                        'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
                    ]
                ];
                break;
        }

        // Créer les produits pour cette catégorie
        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'category_id' => $category->id,
                'stock' => $productData['stock'],
                'seller_id' => $seller->id,
                'image' => $productData['image'] ?? 'default-product.jpg'
            ]);
        }
    }
}
