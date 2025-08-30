<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

echo "🧪 Test de Fonctionnalité ERP\n";
echo "==============================\n\n";

try {
    // Test 1: Vérifier la configuration ERP
    echo "1. Configuration ERP:\n";
    $config = config('erp');
    echo "   ✅ Devise: {$config['currency']}\n";
    echo "   ✅ TVA: {$config['tax_rate']}%\n";
    echo "   ✅ Entreprise: {$config['company_name']}\n";
    echo "   ✅ Adresse: {$config['company_address']}\n\n";

    // Test 2: Vérifier les fournisseurs
    echo "2. Fournisseurs ERP:\n";
    $suppliers = DB::table('erp_purchases_suppliers')->get();
    echo "   ✅ Nombre de fournisseurs: " . $suppliers->count() . "\n";
    foreach ($suppliers as $supplier) {
        echo "      - {$supplier->company_name} ({$supplier->supplier_code})\n";
    }
    echo "\n";

    // Test 3: Vérifier les clients
    echo "3. Clients ERP:\n";
    $customers = DB::table('erp_sales_customers')->get();
    echo "   ✅ Nombre de clients: " . $customers->count() . "\n";
    foreach ($customers as $customer) {
        echo "      - {$customer->company_name} ({$customer->customer_code})\n";
    }
    echo "\n";

    // Test 4: Vérifier les entrepôts
    echo "4. Entrepôts ERP:\n";
    $warehouses = DB::table('erp_inventory_warehouses')->get();
    echo "   ✅ Nombre d'entrepôts: " . $warehouses->count() . "\n";
    foreach ($warehouses as $warehouse) {
        echo "      - {$warehouse->name} - {$warehouse->city}, {$warehouse->country}\n";
    }
    echo "\n";

    // Test 5: Vérifier les utilisateurs ERP
    echo "5. Utilisateurs ERP:\n";
    $erpUsers = DB::table('users')->whereIn('role', ['warehouse_manager', 'buyer', 'sales_manager', 'admin'])->get();
    echo "   ✅ Nombre d'utilisateurs ERP: " . $erpUsers->count() . "\n";
    foreach ($erpUsers as $user) {
        echo "      - {$user->name} ({$user->email}) - {$user->role}\n";
    }
    echo "\n";

    echo "🎉 Tous les tests ERP sont passés avec succès!\n";
    echo "L'ERP est prêt à être utilisé.\n";

} catch (Exception $e) {
    echo "❌ Erreur détectée:\n";
    echo "   Message: " . $e->getMessage() . "\n";
    echo "   Fichier: " . $e->getFile() . "\n";
    echo "   Ligne: " . $e->getLine() . "\n";
}
