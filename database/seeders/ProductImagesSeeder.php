<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Images par défaut pour les produits
        $defaultImages = [
            'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1581094794329-c8112cf8c4e9?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1581094794329-c8112cf8c4e9?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop'
        ];

        // Mettre à jour tous les produits existants avec des images
        $products = Product::all();
        
        foreach ($products as $index => $product) {
            $imageIndex = $index % count($defaultImages);
            $product->update([
                'image' => $defaultImages[$imageIndex]
            ]);
        }

        $this->command->info('Images ajoutées à ' . $products->count() . ' produits.');
    }
}
