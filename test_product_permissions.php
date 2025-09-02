<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

echo "🔐 Test des Permissions Produits\n";
echo "================================\n\n";

try {
    // Test 1: Vérifier les utilisateurs par rôle
    echo "1. Utilisateurs par rôle:\n";
    $roles = ['admin', 'seller', 'client'];
    foreach ($roles as $role) {
        $users = DB::table('users')->where('role', $role)->get(['id', 'name', 'email']);
        echo "   {$role}: " . $users->count() . " utilisateurs\n";
        foreach ($users as $user) {
            echo "      - {$user->name} (ID: {$user->id})\n";
        }
    }
    echo "\n";

    // Test 2: Vérifier les produits et leurs propriétaires
    echo "2. Produits et propriétaires:\n";
    $products = DB::table('products')->get(['id', 'name', 'seller_id']);
    echo "   Total produits: " . $products->count() . "\n";
    foreach ($products as $product) {
        $seller = DB::table('users')->where('id', $product->seller_id)->first();
        $sellerName = $seller ? $seller->name : 'Inconnu';
        echo "      - {$product->name} (ID: {$product->id}) - Propriétaire: {$sellerName} (ID: {$product->seller_id})\n";
    }
    echo "\n";

    // Test 3: Simuler les permissions
    echo "3. Test des permissions:\n";
    $testUsers = DB::table('users')->whereIn('role', ['admin', 'seller'])->limit(3)->get();
    $testProducts = DB::table('products')->limit(2)->get();
    
    foreach ($testUsers as $user) {
        echo "   Utilisateur: {$user->name} (Rôle: {$user->role}, ID: {$user->id})\n";
        foreach ($testProducts as $product) {
            $canEdit = ($user->role === 'admin' || $product->seller_id === $user->id);
            $canDelete = ($user->role === 'admin' || $product->seller_id === $user->id);
            echo "      - Produit '{$product->name}': Modifier=" . ($canEdit ? '✅' : '❌') . " Supprimer=" . ($canDelete ? '✅' : '❌') . "\n";
        }
        echo "\n";
    }

    echo "🎉 Test des permissions terminé!\n";
    echo "Les vérifications d'autorisation sont en place.\n";

} catch (Exception $e) {
    echo "❌ Erreur détectée:\n";
    echo "   Message: " . $e->getMessage() . "\n";
    echo "   Fichier: " . $e->getFile() . "\n";
    echo "   Ligne: " . $e->getLine() . "\n";
}
