<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CleanupCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🧹 Nettoyage des catégories...');

        // 1. Identifier les catégories qui ont des produits avec des images
        $categoriesWithProducts = Category::whereHas('products', function($query) {
            $query->whereNotNull('image');
        })->get();

        $this->command->info('✅ Catégories avec produits (images): ' . $categoriesWithProducts->count());

        // 2. Supprimer les catégories vides ou sans produits avec images
        $emptyCategories = Category::whereDoesntHave('products')->get();
        $categoriesWithoutImages = Category::whereHas('products', function($query) {
            $query->whereNull('image');
        })->get();

        $this->command->info('🗑️ Catégories vides: ' . $emptyCategories->count());
        $this->command->info('🚫 Catégories sans images: ' . $categoriesWithoutImages->count());

        // 3. Supprimer les catégories vides
        foreach ($emptyCategories as $category) {
            $this->command->info('Suppression de la catégorie vide: ' . $category->name);
            $category->delete();
        }

        // 4. Supprimer les catégories sans images
        foreach ($categoriesWithoutImages as $category) {
            $this->command->info('Suppression de la catégorie sans images: ' . $category->name);
            // Supprimer d'abord les produits de cette catégorie
            $category->products()->delete();
            $category->delete();
        }

        // 5. Supprimer les doublons de noms de catégories
        $duplicates = Category::select('name')
            ->groupBy('name')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            $categoriesWithSameName = Category::where('name', $duplicate->name)->get();
            
            // Garder la première et supprimer les autres
            $firstCategory = $categoriesWithSameName->first();
            $others = $categoriesWithSameName->slice(1);
            
            foreach ($others as $other) {
                $this->command->info('Suppression du doublon: ' . $other->name . ' (ID: ' . $other->id . ')');
                // Transférer les produits vers la première catégorie
                $other->products()->update(['category_id' => $firstCategory->id]);
                $other->delete();
            }
        }

        // 6. Afficher le résultat final
        $finalCategories = Category::withCount('products')->get();
        
        $this->command->info('🎯 Résultat final:');
        foreach ($finalCategories as $category) {
            $productsWithImages = $category->products()->whereNotNull('image')->count();
            $this->command->info('- ' . $category->name . ': ' . $category->products_count . ' produits (' . $productsWithImages . ' avec images)');
        }

        $this->command->info('✨ Nettoyage terminé !');
    }
}
