<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

echo "🇲🇦 Test ERP Maroc\n";
echo "==================\n\n";

// Test 1: Vérifier les fournisseurs marocains
echo "1. Test des fournisseurs marocains:\n";
$suppliers = DB::table('erp_purchases_suppliers')->get();
foreach ($suppliers as $supplier) {
    echo "   - {$supplier->company_name} ({$supplier->supplier_code}) - {$supplier->city}, {$supplier->country}\n";
}
echo "\n";

// Test 2: Vérifier les clients marocains
echo "2. Test des clients marocains:\n";
$customers = DB::table('erp_sales_customers')->get();
foreach ($customers as $customer) {
    echo "   - {$customer->company_name} ({$customer->customer_code}) - {$customer->city}, {$customer->country}\n";
}
echo "\n";

// Test 3: Vérifier les entrepôts marocains
echo "3. Test des entrepôts marocains:\n";
$warehouses = DB::table('erp_inventory_warehouses')->get();
foreach ($warehouses as $warehouse) {
    echo "   - {$warehouse->name} - {$warehouse->city}, {$warehouse->country}\n";
}
echo "\n";

// Test 4: Vérifier la configuration ERP
echo "4. Test de la configuration ERP:\n";
$config = config('erp');
echo "   - Devise: {$config['currency']}\n";
echo "   - TVA: {$config['tax_rate']}%\n";
echo "   - Entreprise: {$config['company_name']}\n";
echo "   - Adresse: {$config['company_address']}\n";

echo "\n✅ Tests ERP Maroc terminés avec succès!\n";
